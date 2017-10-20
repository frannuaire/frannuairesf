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

        $em = $this->getDoctrine()->getRepository(Category::class);

        //      $qb = $em->createQueryBuilder('c');
        $qb = $em->createQueryBuilder('cat')
                ->select('cat.id, cat.name, cat.root, cat.usable, t2.id as childId, t2.root as childroot ')
                ->addSelect('
(select count(c.name) from ' . Category::class . ' c where c.root=cat.id) child ')
                //   . ' (select count(*) from Category::class c where c.root=cat.id) child ')
                ->leftJoin(Category::class, 't2', 'WITH', 't2.id=cat.root')
                ->where('cat.root= :id')
                ->setParameter('id', $id)
                //  ->setMaxResults(20)
                ->getQuery();
        $categories = $qb->getResult();
        $nbResult = count($qb->getScalarResult());
        //   die(var_dump($cats));
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
                ->findBy(array('category' => $id, 'state' => 4), array('date' => 'desc', 'prio' => 'desc'), Link::LIST_ITEMS);

        return $this->render('annuaire/category.html.twig', [
                    'categories' => $cat,
                    'selectCategory' => $selectCategory,
                    'textCategory' => $textCategory,
                    'webSites' => $websites,
        ]);
    }

}
