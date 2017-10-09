<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


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
     * @Route("/admin/validesites", name="validesites")
     */
    public function validesitesAction(Request $request) {
        // get website category
        $websites = $this->getDoctrine()
                ->getRepository(\AppBundle\Entity\Link::class)
                ->findBy(array('state' => '4'), array('date' => 'desc', 'prio' => 'desc'), 4);
        // replace this example code with whatever you need
        return $this->render('admin/index.html.twig', [
                    'webSites' => $websites,
        ]);
    }

}
