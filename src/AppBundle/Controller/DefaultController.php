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
                ->findBy(array('state' => Link::STATE_VALID), array('date' => 'desc', 'prio' => 'desc'), Link::HOME_ITEMS);

        return $this->render('default/index.html.twig', [
                    'webSites' => $websites,
        ]);
    }
    
    /**
     * @Route("/mention", name="mention")
     */
    public function mentionAction(Request $request) {
        // get website category

        return $this->render('default/mention.html.twig', [
           'baseUrl'=>$baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath(),        
        ]);
    }
}
