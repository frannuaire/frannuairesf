<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * In
 *
 * @ORM\Table(name="in")
 * @ORM\Entity
 */
class In
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ins", type="integer", nullable=false)
     */
    private $ins;

    /**
     * @var integer
     *
     * @ORM\Column(name="uid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $uid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $date;

    function getIns() {
        return $this->ins;
    }

    function getUid() {
        return $this->uid;
    }

    function getDate(): \DateTime {
        return $this->date;
    }

    function setIns($ins) {
        $this->ins = $ins;
    }

    function setUid($uid) {
        $this->uid = $uid;
    }

    function setDate(\DateTime $date) {
        $this->date = $date;
    }


}

