<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Link;
use AppBundle\Entity\Iplog;
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

        $ip = $request->getClientIp();
        if ($ip == 'unknown') {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $website = $this->getDoctrine()
                ->getRepository(Link::class)
                ->findOneBy(array('id' => $id), array('date' => 'desc', 'prio' => 'desc'));

        $ipLog = $this->getDoctrine()
                ->getRepository(Iplog::class)
                ->findOneBy(array('linkid' => $id, 'ip' => $ip));
        if ($ipLog instanceof Iplog) {
            $modif = false;
        } else {
            $ipLog = new Iplog();
            $modif = true;
        }

        $ipLog->setDate(new \DateTime());
        $ipLog->setIp($ip);
        $ipLog->setClic(1);
        $ipLog->setLinkid($website->getId());
        $em = $this->getDoctrine()->getManager();
        $em->persist($ipLog);
        $em->flush();
        if ($website instanceof Link && $modif) {
            $website->setHits($website->getHits() + 1);
            $em = $this->getDoctrine()->getManager();
            $em->persist($website);
            $em->flush();
            $serializedEntity = $this->container->get('serializer')->serialize($website, 'json');

            return new Response($serializedEntity);
        } else {
            $serializedEntity = $this->container->get('serializer')->serialize('Oh oh something wrong happened', 'json');
            return new Response($serializedEntity);
        }
    }

    /**
     * @Route("/api/links/rating/update/{id}", name="rating-update")
     */
    public function ratingUpdateAction(Request $request, int $id) {
        $rating = $request->request->get('rating');
        $ip = $request->getClientIp();
        if ($ip == 'unknown') {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $website = $this->getDoctrine()
                ->getRepository(Link::class)
                ->findOneBy(array('id' => $id));

        $ipLog = $this->getDoctrine()
                ->getRepository(Iplog::class)
                ->findOneBy(array('linkid' => $id, 'ip' => $ip));
        if ($ipLog instanceof Iplog) {
            if ($ipLog->getVote() == 0) {
                $modif = true;
            } else {
                $modif = false;
            }
        } else {
            $ipLog = new Iplog();
            $modif = true;
        }

        $ipLog->setDate(new \DateTime());
        $ipLog->setIp($ip);
        $ipLog->setVote($rating);
        $ipLog->setLinkid($website->getId());
        $em = $this->getDoctrine()->getManager();
        $em->persist($ipLog);
        $em->flush();

        if ($website instanceof Link && $modif) {
            $website->setVote($website->getVote() + 1);
            $website->setRatingValue($website->getRatingValue() + $rating);
            $em = $this->getDoctrine()->getManager();
            $em->persist($website);
            $em->flush();
            $serializedEntity = $this->container->get('serializer')
                    ->serialize(array('message' => $this->get('translator')
                    ->trans('rating.thanks')), 'json');

            return new Response($serializedEntity);
        } else {
            $serializedEntity = $this->container->get('serializer')
                    ->serialize(array('message' => $this->get('translator')
                    ->trans('rating.alreadydid')), 'json');
            return new Response($serializedEntity);
        }
    }

}
