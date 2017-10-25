<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Link;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AdminController extends Controller {

    /**
     * @Route("/admin", name="homeadmin")
     */
    public function indexAction(Request $request) {

        $websites = $this->getDoctrine()
                ->getRepository(Link::class)
                ->findBy(array('state' => Link::STATE_VALID), array('date' => 'desc', 'prio' => 'desc'), 4);
        return $this->render('admin/index.html.twig', [
                    'webSites' => $websites,
        ]);
    }

    /**
     * @Route("/admin/validate/{message}", name="validate")
     */
    public function validateAction(Request $request, $message = '') {
        $websites = $this->getDoctrine()
                ->getRepository(Link::class)
                ->findBy(array('state' => Link::STATE_PENDING), array('prio' => 'desc', 'date' => 'desc', 'uid' => 'desc'));

        return $this->render('admin/validate.html.twig', [
                    'webSites' => $websites,
                    'message' => $message,
        ]);
    }

    /**
     * @Route("/admin/isvalid/{id}", name="isvalid")
     */
    public function isvalidatAction(Request $request, $id) {

        $em = $this->getDoctrine()->getEntityManager();
        $link = $em->getReference('AppBundle:Link', $id);
        if (!$link) {
            throw $this->createNotFoundException('No website found');
        }
        $link->setState(Link::STATE_PENDING);
        $em->persist($link);
        $em->flush();

        $websites = $this->getDoctrine()
                ->getRepository(Link::class)
                ->findBy(array('state' => Link::STATE_PENDING), array('date' => 'desc', 'uid' => 'desc'));
// pour renvoyer au referer 
        $referer = $request->headers->get('referer');

        return $this->redirect($referer);
        /*     return $this->render('admin/validate.html.twig', [
          'webSites' => $websites,
          'message' => "",
          ]); */
    }

    /**
     * Remove Link
     * @Route("/admin/refuse/{id}", name="refuse")
     */
    public function refuseAction(Request $request, $id) {
        $em = $this->getDoctrine()->getEntityManager();
        $websites = $em->getReference('AppBundle:Link', $id);
        if (!$websites) {
            throw $this->createNotFoundException('No website found');
        }

        $em->remove($websites);
        $em->flush();
        $referer = $request->headers->get('referer');

        return $this->redirect($referer);
        //  return $this->redirectToRoute('validate', array('message' => $this->get('translator')->trans('link.deleted')));
    }

    /**
     * @Route("/admin/checkonline", name="checkonline")
     */
    public function checkonlineAction(Request $request) {

        $formBuilder = $this->createFormBuilder();
        $formBuilder->add('check', SubmitType::class);
        $form = $formBuilder->getForm();

        $websitesKO = $this->getDoctrine()
                ->getRepository(Link::class)
                ->findBy(array('state' => Link::STATE_TROUBLE), array('prio' => 'desc', 'date' => 'desc', 'uid' => 'desc'));
        if ($request->getMethod() == 'POST') {
            $this->checkIt();
        }
        return $this->render('admin/checkonline.html.twig', [
                    'webSites' => $websitesKO,
                    'form' => $form->createView(),
        ]);
    }

    /**
     * check if the link is down and update state to 3 down
     * @return Render
     */
    public function checkIt() {

        $websitesToCheck = $this->getDoctrine()
                ->getRepository(Link::class)
                ->findBy(array('state' => Link::STATE_PENDING), array('prio' => 'desc', 'date' => 'desc', 'uid' => 'desc'), 500);
        set_time_limit(600);
        foreach ($websitesToCheck as $link) {
            if (!$this->url_test($link->getUrl())) {
                $em = $this->getDoctrine()->getManager();
                $link->setState(Link::STATE_TROUBLE);
                $em->persist($link);
                $em->flush();
            }
        }
    }

    /**
     * 
     * @param type $url
     * @return boolean
     */
    public function url_test($url) {
        $timeout = 10;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        $http_respond = curl_exec($ch);
        $http_respond = trim(strip_tags($http_respond));
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if (( $http_code == "200" ) || ( $http_code == "302" ) || ( $http_code == "301" )) {
            return true;
        } else {
            return false;
        }
    }

}
