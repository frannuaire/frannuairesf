<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 * 
 */
class User extends BaseUser implements UserInterface {


    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="isadmin", type="boolean", nullable=false)
     */
    private $isadmin = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="points", type="integer", nullable=false)
     */
    private $points = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;



    function getActive() {
        return $this->active;
    }

    function getIsadmin() {
        return $this->isadmin;
    }

    function getPoints() {
        return $this->points;
    }

    function getId() {
        return $this->id;
    }

    function setActive($active) {
        $this->active = $active;
    }

    function setIsadmin($isadmin) {
        $this->isadmin = $isadmin;
    }

    function setPoints($points) {
        $this->points = $points;
    }

    function setId($id) {
        $this->id = $id;
    }


    public function getSalt() {
        
    }

    public function eraseCredentials() {
        
    }

    /*public function getPassword() {
        return $this->getPass();
    }*/
/*
    public function getUsername() {
        return $this->getLogin();
    }*/

}
