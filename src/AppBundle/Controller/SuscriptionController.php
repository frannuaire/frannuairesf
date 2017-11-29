<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Link;
use AppBundle\Entity\Category;
use AppBundle\Entity\Localbusiness;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use \Symfony\Component\Form\Extension\Core\Type\TextareaType;
use \Symfony\Component\Form\Extension\Core\Type\EmailType;
use \Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use \Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use \Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Form\FormError;
use Gregwar\CaptchaBundle\Type\CaptchaType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class SuscriptionController extends Controller {

    /**
     * @Route("/inscription-basic", name="basic")
     */
    public function basicAction(Request $request) {

        $link = new Link();

        $link->setVote(0);
        $link->setRatingValue(0);
        $usr = $this->get('security.token_storage')->getToken()->getUser();
        if ($usr != "anon.") {
            $link->setUid($usr->getId());
            $link->setEmail($usr->getEmail());
        } else {
            $link->setUid(0);
        }
        $form = $this->createFormBuilder($link)
                ->add('category', ChoiceType::class, array(
                    'choices' => $this->getCategory(),
                    'label' => $this->get('translator')->trans('suscription.category'),
                    'attr' => array('class' => 'form-control'),
                    'required' => true,
                ))
                ->add('name', TextType::class, array(
                    'label' => $this->get('translator')->trans('suscription.name'),
                    'attr' => array('class' => 'form-control', 'placeholder' => $this->get('translator')->trans('suscription.title.placeholder'))
                ))
                ->add('url', UrlType::class, array(
                    'label' => $this->get('translator')->trans('suscription.url'),
                    'attr' => array('class' => 'form-control', 'placeholder' => $this->get('translator')->trans('suscription.url.placeholder'))
                ))
                ->add('description', CKEditorType::class, array(
                    'label' => $this->get('translator')->trans('suscription.description'),
                    'attr' => array('class' => 'form-control')
                ))
                ->add('email', RepeatedType::class, array(
                    'type' => EmailType::class,
                    'invalid_message' => 'The mail fields must match.',
                    'options' => array('attr' => array('class' => 'form-control')),
                    'required' => true,
                    'first_options' => array('label' => $this->get('translator')->trans('suscription.email')),
                    'second_options' => array('label' => $this->get('translator')->trans('suscription.email.confirm')),
                ))
                ->add('image', UrlType::class, array(
                    'label' => $this->get('translator')->trans('suscription.image'),
                    'attr' => array('class' => 'form-control',
                        'placeholder' => $this->get('translator')->trans('suscription.image.placeholder'),
                        'title' => $this->get('translator')->trans('suscription.image.title')
                    ),
                    'required' => false,
                ))
                ->add('date', DateTimeType::class, [
                    'label' => ' ',
                    'required' => false,
                    'attr' => array('style' => 'display:none;'),
                    'date_widget' => 'single_text',
                    'time_widget' => 'single_text',
                    'date_format' => 'dd/MM/yyyy'
                ])
                ->add('captcha', CaptchaType::class, array(
                    'label' => $this->get('translator')->trans('suscription.captcha'),
                    'attr' => array('class' => 'form-control')
                ))
                ->add('save', SubmitType::class, array('label' => $this->get('translator')->trans('suscription.save'),
                    'attr' => array('class' => 'btn btn-dark btn-outline-warning')))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash(
                    'notice', 'Your link was saved!'
            );
            $link = $this->validForm($form);
            if ($link !== false) {
                return $this->redirectToRoute('addbusiness', array('lid' => $link->getId()));
            } else {
                return $this->render('suscription/basic.html.twig', array(
                            'form' => $form->createView(),
                ));
            }
        }

        return $this->render('suscription/basic.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    private function validForm($form) {
        $link = $form->getData();
        if (strlen($link->getDescription()) < Link::MIN_CARACT_VALIDATOR) {
            $form->addError(new FormError($this->get('translator')->trans('description.min')));
            return false;
            return $this->render('suscription/basic.html.twig', array(
                        'form' => $form->createView(),
            ));
        }
        $linkExist = $this->getDoctrine()
                ->getRepository(Link::class)
                ->findOneBy(array('url' => $link->getUrl()));
        if ($link->getUrl() == $linkExist->getUrl()) {
            $form->addError(new FormError($this->get('translator')->trans('link.exist')));
            return false;
            return $this->render('suscription/basic.html.twig', array(
                        'form' => $form->createView(),
            ));
        }
        $link->setState(Link::STATE_PENDING); // Attente de validation

        $em = $this->getDoctrine()->getManager();
        $em->persist($link);
        $em->flush();

        return $link;
        //  return $this->redirectToRoute('homepage');
    }

    /**
     * get Categories for ChoiceType
     * @return Array
     */
    private function getCategory() {
        $cat = $this->getDoctrine()
                ->getRepository(Category::class)
                ->findAll();

        $catUnit = array();
        foreach ($cat as $bu) {
            $catUnit[$bu->getName()] = $bu->getId();
        }

        return $catUnit;
    }

    /**
     * @Route("/suscription-business/{lid}", name="addbusiness")
     */
    public function addbusinessAction(Request $request, $lid) {
        $localBusiness = new Localbusiness();

        $link = $this->getDoctrine()
                ->getRepository(Link::class)
                ->findOneBy(array('id' => $lid));


        $localBusiness->setLid($link->getId());

        $form = $this->createFormBuilder($localBusiness)
                // ->add('lid', HiddenType::class)
                ->add('name', TextType::class, array(
                    'label' => $this->get('translator')->trans('suscription.business.name'),
                    'attr' => array('class' => 'form-control', 'placeholder' => $this->get('translator')->trans('suscription.title.placeholder'))
                ))
                ->add('description', CKEditorType::class, array(
                    'label' => $this->get('translator')->trans('suscription.business.description'),
                    'attr' => array('class' => 'form-control')
                ))
                ->add('email', EmailType::class, array(
                    'attr' => array('class' => 'form-control'),
                    'required' => false,
                    'label' => $this->get('translator')->trans('suscription.email')
                ))
                ->add('telephone', TextType::class, array(
                    'label' => $this->get('translator')->trans('suscription.business.telephone'),
                    'attr' => array('class' => 'form-control', 'placeholder' => $this->get('translator')->trans('+336xxxxxx'))
                ))
                ->add('streetaddress', TextType::class, array(
                    'label' => $this->get('translator')->trans('suscription.business.streetaddress'),
                    'attr' => array('class' => 'form-control', 'placeholder' => $this->get('translator')->trans('suscription.streetaddress.placeholder'))
                ))
                ->add('postalcode', TextType::class, array(
                    'label' => $this->get('translator')->trans('suscription.business.postalcode'),
                    'attr' => array('class' => 'form-control', 'placeholder' => $this->get('translator')->trans('suscription.postalcode.placeholder'))
                ))
                ->add('addresslocality', TextType::class, array(
                    'label' => $this->get('translator')->trans('suscription.business.adresselocality'),
                    'attr' => array('class' => 'form-control', 'placeholder' => $this->get('translator')->trans('suscription.adresselocality.placeholder'))
                ))
                ->add('addresscountry', TextType::class, array(
                    'label' => $this->get('translator')->trans('suscription.business.addresscountry'),
                    'attr' => array('class' => 'form-control', 'placeholder' => $this->get('translator')->trans('suscription.addresscountry.placeholder'))
                ))
                ->add('addressregion', TextType::class, array(
                    'label' => $this->get('translator')->trans('suscription.business.addressregion'),
                    'attr' => array('class' => 'form-control', 'placeholder' => $this->get('translator')->trans('suscription.addressregion.placeholder'))
                ))
                ->add('save', SubmitType::class, array('label' => $this->get('translator')->trans('suscription.save'),
                    'attr' => array('class' => 'btn btn-dark btn-outline-warning')))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->validLocalBusiness($form);
            $this->addFlash(
                    'notice', 'Your link was saved!'
            );
            return $this->redirectToRoute('homepage');
        }

        return $this->render('suscription/business.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

}
