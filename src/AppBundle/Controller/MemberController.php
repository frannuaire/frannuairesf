<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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

/**
 * Description of MemberController
 *
 * @author kferrandon
 */
class MemberController extends Controller {

    /**
     * @Route("/userlink", name="userlink")
     */
    public function indexAction(Request $request) {
        $usr = $this->get('security.token_storage')->getToken()->getUser();

        $websites = $this->getDoctrine()
                ->getRepository(Link::class)
                ->findBy(array('uid' => $usr->getId()), array('date' => 'desc', 'prio' => 'desc'), 4);
        return $this->render('member/userlink.html.twig', [
                    'webSites' => $websites,
        ]);
    }

    /**
     * @Route("/edituserlink/{id}", name="edituserlink")
     */
    public function editAction(Request $request, $id) {
        $usr = $this->get('security.token_storage')->getToken()->getUser();

        $websites = $this->getDoctrine()
                ->getRepository(Link::class)
                ->findOneBy(array('uid' => $usr->getId(), 'id' => $id), array('date' => 'desc', 'prio' => 'desc'), 4);
        //   die(var_dump($websites));
        $form = $this->createFormBuilder($websites)
                ->add('name', TextType::class, array(
                    'label' => $this->get('translator')->trans('sucription.name'),
                    'attr' => array('class' => 'form-control', 'placeholder' => $this->get('translator')->trans('sucription.title.placeholder'))
                ))
                ->add('url', UrlType::class, array(
                    'label' => $this->get('translator')->trans('sucription.url'),
                    'attr' => array('class' => 'form-control',
                        'placeholder' => $this->get('translator')->trans('sucription.url.placeholder'),
                        'readonly' => 'readonly')
                ))
                ->add('description', TextareaType::class, array(
                    'label' => $this->get('translator')->trans('sucription.description'),
                    'attr' => array('class' => 'form-control')
                ))
                ->add('image', UrlType::class, array(
                    'label' => $this->get('translator')->trans('sucription.image'),
                    'attr' => array('class' => 'form-control',
                        'placeholder' => $this->get('translator')->trans('sucription.image.placeholder'),
                        'title' => $this->get('translator')->trans('sucription.image.title')
                    ),
                    'required' => false,
                ))
                ->add('save', SubmitType::class, array('label' => $this->get('translator')->trans('sucription.save'),
                    'attr' => array('class' => 'btn btn-dark btn-outline-warning')))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->validForm($form);
            $this->addFlash(
                    'notice', 'Your link was saved!'
            );
            return $this->redirectToRoute('homepage');
        }

        return $this->render('member/edituser.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    private function validForm($form) {
        $link = $form->getData();
        if (strlen($link->getDescription()) < 1500) {
            $form->addError(new FormError($this->get('translator')->trans('description.min')));
            return $this->render('member/edituser.html.twig', array(
                        'form' => $form->createView(),
            ));
        }
        //  $link->setState(Link::STATE_PENDING); // Attente de validation

        $em = $this->getDoctrine()->getManager();
        $em->persist($link);
        $em->flush();

        return $this->redirectToRoute('homepage');
    }

    /**
     * Remove Link
     * @Route("/member/deletelink/{id}", name="deletelink")
     */
    public function refuseAction(Request $request, $id) {

        $usr = $this->get('security.token_storage')->getToken()->getUser();
        $websites = $this->getDoctrine()
                ->getRepository(Link::class)
                ->findOneBy(array('uid' => $usr->getId(), 'id' => $id));
        $em = $this->getDoctrine()->getManager();
        $em->remove($websites);
        $em->flush();
        $referer = $request->headers->get('referer');
            $this->addFlash(
                    'notice', 'Your link was deleted!'
            );
            return $this->redirectToRoute('homepage');
       // return $this->redirect($referer);
        //  return $this->redirectToRoute('validate', array('message' => $this->get('translator')->trans('link.deleted')));
    }

}
