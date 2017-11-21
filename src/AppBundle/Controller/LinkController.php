<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Link;
use Symfony\Component\HttpFoundation\Response;
use \Symfony\Component\HttpFoundation\JsonResponse;

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
     * @Route("/api/links/hits/update/{id}", name="hits-update")
     */
    public function hitsUpdateAction(Request $request, int $id) {

        $website = $this->getDoctrine()
                ->getRepository(Link::class)
                ->findOneBy(array('id' => $id), array('date' => 'desc', 'prio' => 'desc'));
        //  var_dump($website);die;
        if ($website instanceof Link) {
            $website->setHits($website->getHits() + 1);
            $em = $this->getDoctrine()->getManager();
            $em->persist($website);
            $em->flush();
            $serializedEntity = $this->container->get('serializer')->serialize($website, 'json');

            return new Response($serializedEntity);
        } else {
            return new JsonResponse('Oh oh something wrong happened', Response::HTTP_BAD_REQUEST);
        }
    }

        /**
     * @Route("/api/links/rating/update/{id}", name="rating-update")
     */
    public function ratingUpdateAction(Request $request, int $id) {
$rating = $request->request->get('rating');

        $website = $this->getDoctrine()
                ->getRepository(Link::class)
                ->findOneBy(array('id' => $id));
        //  var_dump($website);die;
        if ($website instanceof Link) {
            $website->setVote($website->getVote() + 1);
            $website->setRatingValue($website->getRatingValue()+$rating);
            $em = $this->getDoctrine()->getManager();
            $em->persist($website);
            $em->flush();
            $serializedEntity = $this->container->get('serializer')->serialize($website, 'json');

            return new Response($serializedEntity);
        } else {
            return new JsonResponse('Oh oh something wrong happened', Response::HTTP_BAD_REQUEST);
        }
    }
}
