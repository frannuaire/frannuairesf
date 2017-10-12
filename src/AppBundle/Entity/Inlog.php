<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 99q5Inlog
 *
 * @ORM\Table(name="99q5_inlog")
 * @ORM\Entity
 */
class Inlog
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=16)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $ip;

    /**
     * @var integer
     *
     * @ORM\Column(name="uid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $uid;
    function getDate(): \DateTime {
        return $this->date;
    }

    function getIp() {
        return $this->ip;
    }

    function getUid() {
        return $this->uid;
    }

    function setDate(\DateTime $date) {
        $this->date = $date;
    }

    function setIp($ip) {
        $this->ip = $ip;
    }

    function setUid($uid) {
        $this->uid = $uid;
    }



}

