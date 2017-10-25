<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Link;
use AppBundle\Entity\Category;
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

class SuscriptionController extends Controller {

    /**
     * @Route("/inscription-basic", name="basic")
     */
    public function basicAction(Request $request) {

        // create a task and give it some dummy data for this example
        $link = new Link();
        // $date = new DateTime();
        //  die(var_dump($date));

        $form = $this->createFormBuilder($link)
                ->add('category', ChoiceType::class, array(
                    'choices' => $this->getCategory(),
                    'attr' => array('class' => 'form-control'),
                    'required' => true,
                ))
                ->add('name', TextType::class, array(
                    'label' => $this->get('translator')->trans('name'),
                    'attr' => array('class' => 'form-control', 'placeholder' => $this->get('translator')->trans('title.placeholder'))
                ))
                ->add('url', UrlType::class, array(
                    'label' => $this->get('translator')->trans('url'),
                    'attr' => array('class' => 'form-control', 'placeholder' => $this->get('translator')->trans('url.placeholder'))
                ))
                ->add('description', TextareaType::class, array(
                    'label' => $this->get('translator')->trans('description'),
                    'attr' => array('class' => 'form-control')
                ))
                ->add('email', RepeatedType::class, array(
                    'type' => EmailType::class,
                    'invalid_message' => 'The mail fields must match.',
                    'options' => array('attr' => array('class' => 'form-control')),
                    'required' => true,
                    'first_options' => array('label' => $this->get('translator')->trans('email')),
                    'second_options' => array('label' => $this->get('translator')->trans('email.confirm')),
                ))
                ->add('image', UrlType::class, array(
                    'label' => $this->get('translator')->trans('image'),
                    'attr' => array('class' => 'form-control',
                        'placeholder' => $this->get('translator')->trans('image.placeholder'),
                        'title' => $this->get('translator')->trans('image.placeholder')
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
                ->add('save', SubmitType::class, array('label' => $this->get('translator')->trans('save'),
                    'attr' => array('class' => 'btn btn-dark btn-outline-warning')))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->validForm($form);
                 $this->addFlash(
            'notice',
            'Your link were saved!'
        );
            return $this->redirectToRoute('homepage');
        }

        return $this->render('suscription/basic.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    private function validForm($form) {
        $link = $form->getData();
        if (strlen($link->getDescription()) < 1500) {
            $form->addError(new FormError($this->get('translator')->trans('description.min')));
            return $this->render('suscription/basic.html.twig', array(
                        'form' => $form->createView(),
            ));
        }
        $link->setState(Link::STATE_PENDING); // Attente de validation

        $em = $this->getDoctrine()->getManager();
        $em->persist($link);
        $em->flush();

        return $this->redirectToRoute('homepage');
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

}
