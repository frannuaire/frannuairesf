<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category {

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="root", type="integer", nullable=false)
     */
    private $root = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="usable", type="boolean", nullable=false)
     */
    private $usable = true;

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

    function getRoot() {
        return $this->root;
    }

    function getUsable() {
        return $this->usable;
    }

    function getId() {
        return $this->id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setRoot($root) {
        $this->root = ($root === null) ? 0 : $root;
    }

    function setUsable($usable) {
        $this->usable = $usable;
    }

    function setId($id) {
        $this->id = $id;
    }

}
