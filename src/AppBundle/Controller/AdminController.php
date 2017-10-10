<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Link;

class AdminController extends Controller {

    /**
     * @Route("/admin", name="homeadmin")
     */
    public function indexAction(Request $request) {
        // get website category
        $websites = $this->getDoctrine()
                ->getRepository(\AppBundle\Entity\Link::class)
                ->findBy(array('state' => '4'), array('date' => 'desc', 'prio' => 'desc'), 4);
        // replace this example code with whatever you need
        return $this->render('admin/index.html.twig', [
                    'webSites' => $websites,
        ]);
    }

    /**
     * @Route("/admin/validate/{message}", name="validate")
     */
    public function validateAction(Request $request, $message = '') {
        // get website category
        $websites = $this->getDoctrine()
                ->getRepository(\AppBundle\Entity\Link::class)
                ->findBy(array('state' => '1'), array('prio' => 'desc', 'date' => 'desc', 'uid' => 'desc'));
        // replace this example code with whatever you need
        return $this->render('admin/validate.html.twig', [
                    'webSites' => $websites,
                    'message' => $message,
        ]);
    }

    /**
     * @Route("/admin/isvalid", name="isvalid")
     */
    public function isvalidatAction(Request $request) {
        // get website category
        $websites = $this->getDoctrine()
                ->getRepository(\AppBundle\Entity\Link::class)
                ->findBy(array('state' => '1'), array('date' => 'desc', 'uid' => 'desc'));
        // replace this example code with whatever you need
        return $this->render('admin/validate.html.twig', [
                    'webSites' => $websites,
                    'message' => "",
        ]);
    }

    /**
     * @Route("/admin/refuse/{id}", name="refuse")
     */
    public function refuseAction($id) {
    

        $em = $this->getDoctrine()->getEntityManager();
        $websites = $em->getReference('AppBundle:Link', $id);
        if (!$websites) {
            throw $this->createNotFoundException('No website found');
        }

        $em->remove($websites);
        $em->flush();
        // replace this example code with whatever you need
        return $this->redirectToRoute('validate', array('message'=>$this->get('translator')->trans('link.deleted')));
        
    }

}
