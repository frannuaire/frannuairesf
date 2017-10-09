<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * 99q5User
 *
 * @ORM\Table(name="99q5_user")
 * @ORM\Entity
 */
class User implements UserInterface {

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=33, nullable=false)
     */
    private $login = '';

    /**
     * @var string
     *
     * @ORM\Column(name="pass", type="string", length=33, nullable=false)
     */
    private $pass = '';

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    private $email = '';

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
    private $id;

    function getLogin() {
        return $this->login;
    }

    function getPass() {
        return $this->pass;
    }

    function getEmail() {
        return $this->email;
    }

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

    function setLogin($login) {
        $this->login = $login;
    }

    function setPass($pass) {
        $this->pass = $pass;
    }

    function setEmail($email) {
        $this->email = $email;
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

    public function getRoles() {
        if ($this->getIsadmin() == '1') {
            return array('ROLE_ADMIN');
        } else {
            return array('ROLE_USER');
        }
    }

    public function getSalt() {
        
    }

    public function eraseCredentials() {
        
    }

    public function getPassword() {
        return $this->getPass();
    }

    public function getUsername() {
        return $this->getLogin();
    }

}
