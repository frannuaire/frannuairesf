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
                ->findOneBy(array('catexCategory'=>$id));

        // get sub category
        $cat = $this->getDoctrine()
                ->getRepository(\AppBundle\Entity\Category::class)
                ->findBy(array('root' => $id));
        
        // get website category
        $websites = $this->getDoctrine()
                ->getRepository(\AppBundle\Entity\Link::class)
                ->findBy(array('category' => $id),array('date'=>'desc','prio'=>'desc'), 10);
       
                return $this->render('annuaire/category.html.twig', [
                    'categories' => $cat,
                    'selectCategory' =>$selectCategory,
                    'textCategory' =>$textCategory,
                    'webSites' => $websites, 
        ]);
    }

}
