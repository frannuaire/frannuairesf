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
        $cat = $this->getDoctrine()
                ->getRepository(\AppBundle\Entity\Category::class)
                ->findBy(array('root' => $id));
       
                return $this->render('annuaire/category.html.twig', [
                    'categories' => $cat,
        ]);
    }

}
