<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        // get website category
        $websites = $this->getDoctrine()
                ->getRepository(\AppBundle\Entity\Link::class)
                ->findBy(array('state' => 4), array('date' => 'desc', 'prio' => 'desc'), 4);
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
                    'webSites' => $websites,
        ]);
    }

}
