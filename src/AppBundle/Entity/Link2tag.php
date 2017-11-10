<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Link2tag
 *
 * @ORM\Table(name="link2tag")
 * @ORM\Entity
 */
class Link2tag
{
    /**
     * @var integer
     *
     * @ORM\Column(name="lid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $lid;

    /**
     * @var integer
     *
     * @ORM\Column(name="tid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $tid;
    
    function getLid() {
        return $this->lid;
    }

    function getTid() {
        return $this->tid;
    }

    function setLid($lid) {
        $this->lid = $lid;
    }

    function setTid($tid) {
        $this->tid = $tid;
    }



}

