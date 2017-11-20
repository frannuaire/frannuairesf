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

    /**
     * @Route("/api/links/hits/{id}/update", name="hits-update")
     */
    public function hitsUpdateAction(Request $request, int $id) {
        $website = $this->getDoctrine()
                ->getRepository(Link::class)
                ->findOneBy(array('id' => $id), array('date' => 'desc', 'prio' => 'desc'));

        if ($website instanceof Link) {
            $website->setHits($website->getHits() + 1);
            $em = $this->getDoctrine()->getManager();
            $em->persist($website);
            $em->flush();

            return new Response('Updated Hit', Response::HTTP_OK);
        }
        else{
            return new Response('Oh oh something wrong happened', Response::HTTP_BAD_REQUEST);
        }
    }

}
