<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pub
 *
 * @ORM\Table(name="pub")
 * @ORM\Entity
 */
class Pub
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_emp", type="integer", nullable=false)
     */
    private $idEmp;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="text", length=65535, nullable=false)
     */
    private $code;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    function getName() {
        return $this->name;
    }

    function getIdEmp() {
        return $this->idEmp;
    }

    function getCode() {
        return $this->code;
    }

    function getId() {
        return $this->id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setIdEmp($idEmp) {
        $this->idEmp = $idEmp;
    }

    function setCode($code) {
        $this->code = $code;
    }

    function setId($id) {
        $this->id = $id;
    }


}

