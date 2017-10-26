<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Category;
use AppBundle\Entity\Link;
use AppBundle\Entity\Categorytext;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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

    /**
     * @Route("/admin/category-delete/{id}", name="admin-category-delete")
     */
    public function adminCategoryDeleteAction(Request $request, $id = 0) {
        $categories = $this->getDoctrine()
                ->getRepository(Category::class)
                ->findOneBy(array('id' => $id));

        if (null !== $categories) {

            $this->addFlash(
                    'notice', $this->get('translator')->trans('category.deleted')
            );
        }
        return $this->redirectToRoute('admin-category-list');
    }

    /**
     * @Route("/admin/category-update/{id}", name="admin-category-update")
     */
    public function adminCategotyUpdateAction(Request $request, $id = 0) {

        $selectParent = $this->getDoctrine()->getRepository(Category::class)->getCategoryForSelect();

        $categories = $this->getDoctrine()
                ->getRepository(Category::class)
                ->findOneBy(array('id' => $id));

        if (null === $categories) {
            $categories = new Category();
        }

        $categorieForm = new Category();

        $form = $this->createFormBuilder($categorieForm)
                ->add('root', ChoiceType::class, array(
                    'choices' => $selectParent,
                    'attr' => array('class' => 'form-control'),
                    'required' => true,
                    'data' => $categories->getRoot(),
                ))
                ->add('name', TextType::class, array(
                    'label' => $this->get('translator')->trans('name'),
                    'data' => $categories->getName(),
                    'attr' => array('class' => 'form-control', 'placeholder' => $this->get('translator')->trans('category.placeholder'))
                ))
                ->add('usable', CheckboxType::class, array(
                    'label' => $this->get('translator')->trans('allow.submition'),
                    'data' => $categories->getUsable(),
                    'required' => false,
                ))
                ->add('save', SubmitType::class, array('label' => $this->get('translator')->trans('category.update'),
                    'attr' => array('class' => 'btn btn-dark btn-outline-warning')))
                ->getForm();



        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categorie = $form->getData();
            // $categorie->setState(1); // Attente de validation
            // var_dump($categorie);die;
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();
        }

        return $this->render('admin/category/category.form.html.twig', [
                    'form' => $form->createView(),
        ]);
    }

}
