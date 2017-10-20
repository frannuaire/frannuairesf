<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use \AppBundle\Entity\Link;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        // get website category
        $websites = $this->getDoctrine()
                ->getRepository(Link::class)
                ->findBy(array('state' => '4'), array('date' => 'desc', 'prio' => 'desc'), Link::HOME_ITEMS);

        return $this->render('default/index.html.twig', [
                    'webSites' => $websites,
        ]);
    }

}
