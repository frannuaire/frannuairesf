<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class SecurityController extends Controller {

    /**
     * @Route("/login2", name="login2")
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils) {

        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
                    'last_username' => $lastUsername,
                    'error' => $error,
        ));
    }



    /**
     * @Route("/logout2/", name="logout2")
     */
    public function logoutAction() {
        
    }

}
