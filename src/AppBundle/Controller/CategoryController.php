<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Category;
use AppBundle\Entity\Link;
use AppBundle\Entity\Categorytext;

class CategoryController extends Controller {

    /**
     * @Route("/admin/category-list/{id}", name="admin-category-list")
     */
    public function indexAction(Request $request, $id = 0) {

        $categories = $this->getDoctrine()->getRepository(Category::class)->findWithSubCategory($id);
        $nbResult = $this->getDoctrine()->getRepository(Category::class)->countLastResultElements();

        if ($nbResult == 0) {
            $categories = $this->getDoctrine()
                    ->getRepository(Category::class)
                    ->findBy(array('root' => $id));
        }


        // replace this example code with whatever you need
        return $this->render('admin/category/index.html.twig', [
                    'categories' => $categories,
        ]);
    }

    /**
     * @Route("/category/{id}", name="_category")
     * 
     */
    public function categoryAction(Request $request, $id) {
        // get current category
        $selectCategory = $this->getDoctrine()
                ->getRepository(Category::class)
                ->find($id);
        // get current category text
        $textCategory = $this->getDoctrine()
                ->getRepository(Categorytext::class)
                ->findOneBy(array('catexCategory' => $id));

        // get sub category
        $cat = $this->getDoctrine()
                ->getRepository(Category::class)
                ->findBy(array('root' => $id));

        // get website category
        $websites = $this->getDoctrine()
                ->getRepository(Link::class)
                ->findBy(array('category' => $id, 'state' => Link::STATE_VALID), array('date' => 'desc', 'prio' => 'desc'), Link::LIST_ITEMS);


        return $this->render('annuaire/category.html.twig', [
                    'categories' => $cat,
                    'selectCategory' => $selectCategory,
                    'textCategory' => $textCategory,
                    'webSites' => $websites,
        ]);
    }

}
