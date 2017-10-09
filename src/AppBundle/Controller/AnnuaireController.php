<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of AnnuaireController
 *
 * @author kferrandon
 */
class AnnuaireController extends Controller {

    /**
     * @Route("/listcategory", name="listcategory")
     */
    public function listcategoryAction(Request $request) {
        $cat = $this->getDoctrine()
                ->getRepository(\AppBundle\Entity\Category::class)
                ->findBy(array('root' => 0));
        // replace this example code with whatever you need
        return $this->render('annuaire/listcategory.html.twig', [
                    'categories' => $cat,
        ]);
    }

    /**
     * @Route("/category/{id}", name="_category")
     * 
     */
    public function categoryAction(Request $request, $id) {
        // get current category
        $selectCategory = $this->getDoctrine()
                ->getRepository(\AppBundle\Entity\Category::class)
                ->find($id);
        // get current category text
        $textCategory = $this->getDoctrine()
                ->getRepository(\AppBundle\Entity\Categorytext::class)
                ->findOneBy(array('catexCategory' => $id));

        // get sub category
        $cat = $this->getDoctrine()
                ->getRepository(\AppBundle\Entity\Category::class)
                ->findBy(array('root' => $id));

        // get website category
        $websites = $this->getDoctrine()
                ->getRepository(\AppBundle\Entity\Link::class)
                ->findBy(array('category' => $id, 'state'=>4), 
                        array('date' => 'desc', 'prio' => 'desc'), 10);

        return $this->render('annuaire/category.html.twig', [
                    'categories' => $cat,
                    'selectCategory' => $selectCategory,
                    'textCategory' => $textCategory,
                    'webSites' => $websites,
        ]);
    }

    /**
     * @Route("/detail/{id}", name="_website")
     */
    public function detailsiteAction($id) {
        $site = $this->getDoctrine()
                ->getRepository(\AppBundle\Entity\Link::class)
                ->find($id);
        $comments = $this->getDoctrine()
                ->getRepository(\AppBundle\Entity\Comment::class)
                ->findBy(array('lid' => $id));
        $rss = $this->getDoctrine()
                ->getRepository(\AppBundle\Entity\Feed::class)
                ->findBy(array('linkid' => $id));

        $sxe = null;
        if (count($rss) > 0) {
            $file = $rss[0]->getfeed();
            $file_headers = @get_headers($file);
            if (!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found' || $file_headers[0] == 'HTTP/1.0 404 Not Found') {
                $sxe = null;
            } else {
                 $sxe = simplexml_load_file($rss[0]->getfeed());
            }
        }

        // die(var_dump($sxe));
        return $this->render('annuaire/details.html.twig', [
                    'webSites' => $site,
                    'comments' => $comments,
                    'rss' => $sxe,
        ]);
    }

}