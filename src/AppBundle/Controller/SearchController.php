<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Keyword;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SearchController extends Controller {

    /**
     * @Route("/admin/keywords", name="keywords")
     */
    public function indexAction(Request $request) {

        $keywords = $this->getDoctrine()
                ->getRepository(Keyword::class)
                ->findBy(array(),array('hasresults' => 'asc', 'date' => 'desc' ));

        return $this->render('admin/keywords.html.twig', [
                    'keywords' => $keywords,
        ]);
    }


}
