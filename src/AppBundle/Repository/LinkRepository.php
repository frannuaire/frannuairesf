<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Description of LinkRepository
 *
 * @author kferrandon
 */
class LinkRepository extends EntityRepository {

    protected $lastQuery;

    /**
     * 
     * @param string $keywords
     * @return array
     */
    function findByKeywords($keywords) {

        $qb = $this->createQueryBuilder('l');
        $query = $qb->where(
                        $qb->expr()->like('l.name', ':keyword')
                )
                ->orWhere($qb->expr()->like('l.url', ':keydesc'))
                ->setParameter('keyword', '%' . $keywords . '%')
                ->setParameter('keydesc', '%' . $keywords . '%')
                ->getQuery();
        $this->setLastQuery($query);
        return $query->getResult();
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

}
