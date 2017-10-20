<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Category;

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
(select count(c.name) from '.Category::class.' c where c.root=cat.id) child ')
                     //   . ' (select count(*) from Category::class c where c.root=cat.id) child ')
                ->leftJoin(Category::class, 't2', 'WITH', 't2.id=cat.root')
                ->where('cat.root= :id')
                ->setParameter('id', $id)
              //  ->setMaxResults(20)
                ->getQuery();
        $categories = $qb->getResult();
        $nbResult = count($qb->getScalarResult());
    //   die(var_dump($cats));
       if($nbResult==0){
                   $categories = $this->getDoctrine()
                    ->getRepository(Category::class)
                    ->findBy(array('root' => $id));
        }


        // replace this example code with whatever you need
        return $this->render('admin/category/index.html.twig', [
                    'categories' => $categories,
        ]);
    }

}
