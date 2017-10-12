<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 99q5Cat2pub
 *
 * @ORM\Table(name="99q5_cat2pub")
 * @ORM\Entity
 */
class Cat2pub
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcat", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idcat;

    /**
     * @var integer
     *
     * @ORM\Column(name="idpub", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idpub;

    function getIdcat() {
        return $this->idcat;
    }

    function getIdpub() {
        return $this->idpub;
    }

    function setIdcat($idcat) {
        $this->idcat = $idcat;
    }

    function setIdpub($idpub) {
        $this->idpub = $idpub;
    }


}

