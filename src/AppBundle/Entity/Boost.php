<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 99q5Boost
 *
 * @ORM\Table(name="99q5_boost")
 * @ORM\Entity
 */
class Boost
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_allopass", type="boolean", nullable=false)
     */
    private $isAllopass = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    function getDate(): \DateTime {
        return $this->date;
    }

    function getIsAllopass() {
        return $this->isAllopass;
    }

    function getId() {
        return $this->id;
    }

    function setDate(\DateTime $date) {
        $this->date = $date;
    }

    function setIsAllopass($isAllopass) {
        $this->isAllopass = $isAllopass;
    }

    function setId($id) {
        $this->id = $id;
    }



}

