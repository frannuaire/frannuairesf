<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * Localbusiniess
 * @ApiResource(
 *     collectionOperations={"get"={"method"="GET"}},
 *     itemOperations={"get"={"method"="GET"}}
 * )
 * @ORM\Entity
 * @ORM\Table(name="localbusiness")
 */
class Localbusiness {

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer" )
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     * @ORM\Column(name="lid", type="integer", nullable=false )
     */
    private $lid = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="siret", type="string", length=255, nullable=true)
     */
    private $siret;

    /** adresse * */

    /**
     * @var string
     *
     * @ORM\Column(name="addresslocality", type="string", length=255, nullable=true)
     */
    private $addresslocality;

    /**
     * @var string
     *
     * @ORM\Column(name="streetaddress", type="string", length=255, nullable=true)
     */
    private $streetaddress;

    /**
     * @var string
     *
     * @ORM\Column(name="adresscountry", type="string", length=255, nullable=true)
     */
    private $addresscountry;

    /**
     * @var string
     *
     * @ORM\Column(name="addressregion", type="string", length=255, nullable=true)
     */
    private $addressregion;

    /**
     * @var string
     *
     * @ORM\Column(name="postalcode", type="string", length=50, nullable=true)
     */
    private $postalcode;

    public function getId() {
        return $this->id;
    }

    public function getLid() {
        return $this->lid;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getName() {
        return $this->name;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSiret() {
        return $this->siret;
    }

    public function getAddresslocality() {
        return $this->addresslocality;
    }

    public function getStreetaddress() {
        return $this->streetaddress;
    }

    public function getAddresscountry() {
        return $this->addresscountry;
    }

    public function getAddressregion() {
        return $this->addressregion;
    }

    public function getPostalcode() {
        return $this->postalcode;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setLid($lid) {
        $this->lid = $lid;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setSiret($siret) {
        $this->siret = $siret;
    }

    public function setAddresslocality($adresslocality) {
        $this->addresslocality = $adresslocality;
    }

    public function setStreetaddress($streetaddress) {
        $this->streetaddress = $streetaddress;
    }

    public function setAddresscountry($addresscountry) {
        $this->addresscountry = $addresscountry;
    }

    public function setAddressregion($addressregion) {
        $this->addressregion = $addressregion;
    }

    public function setPostalcode($postalcode) {
        $this->postalcode = $postalcode;
    }

}
