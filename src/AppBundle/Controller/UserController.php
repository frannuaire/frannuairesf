<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @Route("/board", name="board")
     */
    public function boardAction(Request $request)
    {
        // replace this example code with whatever you need
          return $this->render('user/board.html.twig', [
            
        ]);
        

    }
}
