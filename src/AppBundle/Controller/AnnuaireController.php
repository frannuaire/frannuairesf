<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Category;
use AppBundle\Entity\Link;
use AppBundle\Entity\Comment;
use AppBundle\Entity\Feed;
use AppBundle\Entity\Localbusiness;

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
                ->getRepository(Category::class)
                ->findBy(array('root' => 0));
        
        return $this->render('annuaire/listcategory.html.twig', [
                    'categories' => $cat,
        ]);
    }

    /**
     * @Route("/detail/{id}", name="_website")
     */
    public function detailsiteAction($id) {
        $site = $this->getDoctrine()
                ->getRepository(Link::class)
                ->find($id);
        $comments = $this->getDoctrine()
                ->getRepository(Comment::class)
                ->findBy(array('lid' => $id));
        $nbComments=count($comments);
       
        $rss = $this->getDoctrine()
                ->getRepository(Feed::class)
                ->findBy(array('id' => $id));
        
        $category = $this->getDoctrine()
                ->getRepository(Category::class)
                ->find($site->getCategory());
        
        $localBusiness = $this->getDoctrine()
                ->getRepository(Localbusiness::class)
                ->findOneBy(array("lid"=>$site->getId()));

        $sxe = null;
        if (count($rss) > 0) {
            $file = $rss[0]->getfeed();
            $file_headers = @get_headers($file);
            if (!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found' || $file_headers[0] == 'HTTP/1.0 404 Not Found') {
                $sxe = null;
            } else {
                try {
                    $sxe = simplexml_load_file($rss[0]->getfeed());
                    if ($sxe === false) {
                        $sxe = null;
                    }
                } catch (Exception $e) {
                     $sxe = null;
                }
            }
        }
                    return $this->render('annuaire/details.html.twig', [
                        'webSites' => $site,
                        'comments' => $comments,
                        'nbComments'=>$nbComments,
                        'rss' => $sxe,
                        'category'=>$category,
                        'localbusiness'=>$localBusiness,
            ]);
    }
}    
    