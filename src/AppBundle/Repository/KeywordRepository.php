<?php

namespace AppBundle\Repository;

use \Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Keyword;

/**
 * Description of KeywordRepository
 *
 * @author kferrandon
 */
class KeywordRepository extends EntityRepository {

    public function findAndUpdate($keywords, $nbResult, $emKey) {

        $key = $this->findBy(array('word' => $keywords));

        //     $emKey = $this->getManager();
        if (count($key) > 0) {
            //   die(var_dump($key[0]->getOccurence()+1));

            $key[0]->setOccurence($key[0]->getOccurence() + 1);
            if ($nbResult > 0) {
                $key[0]->setHasResults(1);
            }
            $emKey->persist($key[0]);
            $emKey->flush();
        } else {
            $key = new Keyword();
            $key->setDate(new DateTime());
            if ($nbResult > 0) {
                $key->setHasresults(1);
            } else {
                $key->setHasresults(0);
            }
            $key->setOccurence(1);
            $key->setWord($keywords);
            $emKey->persist($key);
            $emKey->flush();
        }
    }

}
