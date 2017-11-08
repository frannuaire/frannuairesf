<?php

namespace AppBundle\Repository;

use \Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Category;

/**
 * Description of CategoryRepository
 *
 * @author kferrandon
 */
class CategoryRepository extends EntityRepository {

    protected $lastQuery;

    public function findWithSubCategory($id) {

        $qb = $this->createQueryBuilder('cat')
                ->select('cat.id, cat.name, cat.root, cat.usable, t2.id as childId, t2.root as childroot ')
                ->addSelect('
(select count(c.name) from ' . Category::class . ' c where c.root=cat.id) child ')
                //   . ' (select count(*) from Category::class c where c.root=cat.id) child ')
                ->leftJoin(Category::class, 't2', 'WITH', 't2.id=cat.root')
                ->where('cat.root= :id')
                ->setParameter('id', $id)
                //  ->setMaxResults(20)
                ->getQuery();
        $this->setLastQuery($qb);

        return $qb->getResult();
    }

    /**
     * use this after each select query
     * @param Query $lastQuery
     */
    public function setLastQuery($lastQuery) {
        $this->lastResult = $lastQuery;
        return $this;
    }

    /**
     * return last number query result elements
     * @return int
     */
    public function countLastResultElements(): int {
        return count($this->lastResult->getScalarResult());
    }

    /**
     * get Categories for ChoiceType
     * @return Array
     */
    public function getCategoryForSelect(): Array {
        $cat = $this->findAll();

        $catUnit = array();
        $catUnit['root']=0;
        foreach ($cat as $bu) {
            $catUnit[$bu->getName()] = $bu->getId();
        }

        return $catUnit;
    }

}
