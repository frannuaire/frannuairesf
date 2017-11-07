<?php

namespace CommentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use \AppBundle\Entity\Comment;

class DefaultController extends Controller {

    /**
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/admin/comment/list-comments", name="listComments")
     */
    public function indexAction() {

        $comments = $this->getDoctrine()
                ->getRepository(Comment::class)
                ->findBy(array('approved' => Comment::TO_APPROVE));
        return $this->render('CommentBundle:admin:approve.html.twig', array(
                    'comments' => $comments
        ));
    }

    /**
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/admin/comment/refused-comment/{id}", name="refusedComment")
     */
    public function refusedAction(Request $request, $id) {

        $em = $this->getDoctrine()->getEntityManager();
        $comment = $em->getReference('AppBundle:Comment', $id);
        if (!$comment) {
            throw $this->createNotFoundException('No comment found');
        }

        $em->remove($comment);
        $em->flush();
        $referer = $request->headers->get('referer');

        return $this->redirect($referer);
    }

    /**
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/admin/comment/approved-comment/{id}", name="approvedComment")
     */
    public function approvedAction(Request $request, $id) {

        $em = $this->getDoctrine()->getEntityManager();
        $comment = $em->getReference('AppBundle:Comment', $id);
        if (!$comment) {
            throw $this->createNotFoundException('No comment found');
        }
        $comment->setApproved(1);
        $em->persist($comment);
        $em->flush();
        $referer = $request->headers->get('referer');

        return $this->redirect($referer);
    }

}
