<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Keyword;
use AppBundle\Entity\Link;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use \DateTime;

class SearchController extends Controller {

    /**
     * @Route("/admin/keywords", name="keywords")
     */
    public function indexAction(Request $request) {

        $keywords = $this->getDoctrine()
                ->getRepository(Keyword::class)
                ->findBy(array(), array('hasresults' => 'asc', 'date' => 'desc'));

        return $this->render('admin/keywords.html.twig', [
                    'keywords' => $keywords,
        ]);
    }

    /**
     * @Route("/search", name="search")
     */
    public function searchAction(Request $request) {
        $param = explode('=', $request->getRequestUri());
        $keywords = $param[1];
        if (null !== $keywords) {
            $keywords = preg_replace('/\+/', '%', $keywords);

            $em = $this->getDoctrine()->getManager();

            $websites = $this->getDoctrine()->getRepository(Link::class)->findByKeywords($keywords);

            $nbResult = $this->getDoctrine()->getRepository(Link::class)->countLastResultElements();
            $keywords = preg_replace('/\%/', ' ', $keywords);

            $emKey = $this->getDoctrine()->getManager();
            $emKey = $this->getDoctrine()->getRepository(Keyword::class)->findAndUpdate($keywords, $nbResult, $emKey);

            return $this->render('search/index.html.twig', [
                        'webSites' => $websites,
                        'keys' => $keywords,
                        'nbRes' => $nbResult,
            ]);
        } else {
            return $this->redirectToRoute('homepage');
        }
    }

}
