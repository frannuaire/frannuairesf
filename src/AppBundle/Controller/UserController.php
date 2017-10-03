<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class UserController extends Controller
{    /**
     * @Route("/board", name="board")
     *
     */

    public function boardAction(Request $request)
    {
    
    $user  = $this->getUser()->getUsername();
   // die(var_dump($user));
        // replace this example code with whatever you need
          return $this->render('user/board.html.twig', [
            
        ]);
        

    }
    
}
