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
     * @Route("/admin/search", name="search")
     */
    public function searchAction(Request $request) {
        $param = explode('=', $request->getRequestUri());
        $keywords = $param[1];
        if (null !== $keywords) {
          //  $lstWords = explode('+', $keywords);
           $keywords = preg_replace('/\+/', '%', $keywords);
            // $qb = $this->getDoctrine()->createQueryBuilder(Link::class);
            $em = $this->getDoctrine()->getRepository(Link::class);

      $qb =  $em->createQueryBuilder('l');          
            $query =$qb->where($qb->expr()->orX(
                                    $qb->expr()->like('l.name', ':keyword')
                            ))
                 /*   $qb->expr()->orX(
                                    $qb->expr()->like('l.description', ':keydesc')
                            )
                    ),*/
                    ->orWhere($qb->expr()->like('l.url', ':keydesc'))
                    ->setParameter('keyword', '%'.$keywords.'%')
                    ->setParameter('keydesc', '%'.$keywords.'%')
                    ->getQuery();



            $websites = $query->getResult();
            $nbResult = count($query->getScalarResult());
             $keywords = preg_replace('/\%/', ' ', $keywords);
           // die(var_dump()));
            return $this->render('search/index.html.twig', [
                        'webSites' => $websites,
                'keys'=>$keywords,
                'nbRes'=>$nbResult,
            ]);
        } else {
            return $this->redirectToRoute('homepage');
        }

    }

}
