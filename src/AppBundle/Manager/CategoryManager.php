<?php

/**
 * Description of Category
 *
 * @author kferrandon
 */

namespace AppBundle\Manager;

use Doctrine\ORM\EntityManagerInterface;

class CategoryManager {

    private $em;

    /**
     * @param EntityManager
     */
    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function addCategory(\AppBundle\Entity\Category $category) {

        if (null === $category) {
            throw new Exception('Miss Category');
        }
        $this->em->persist($category);
        $this->em->flush();
    }

}
