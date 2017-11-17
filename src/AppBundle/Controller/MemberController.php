<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Link;
/**
 * Description of MemberController
 *
 * @author kferrandon
 */
class MemberController extends Controller{
  
     /**
     * @Route("/userlink", name="userlink")
     */
    public function indexAction(Request $request) {

        $websites = $this->getDoctrine()
                ->getRepository(Link::class)
                ->findBy(array('state' => Link::STATE_VALID), array('date' => 'desc', 'prio' => 'desc'), 4);
        return $this->render('member/index.html.twig', [
                    'webSites' => $websites,
        ]);
    }
    
    
}
