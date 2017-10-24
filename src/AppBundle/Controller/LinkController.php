<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Link;
use Symfony\Component\HttpFoundation\Response;


class LinkController extends Controller {

    /**
     * @Route("/admin/banned", name="banned")
     */
    public function bannedAction(Request $request) {

        $websites = $this->getDoctrine()
                ->getRepository(Link::class)
                ->findBy(array('state' => Link::STATE_BANNED), array('date' => 'desc', 'prio' => 'desc'));
        return $this->render('admin/banned.html.twig', [
                    'webSites' => $websites,
        ]);
    }

  

}
