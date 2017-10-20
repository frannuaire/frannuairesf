<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * 99q5Link
 *
 * @ORM\Table(name="99q5_link")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LinkRepository")
 */
class Link {

     const HOME_ITEMS = 4;
     const LIST_ITEMS = 8;
     
    /**
     * @var integer
     * @ORM\Column(name="uid", type="integer", nullable=false )
     */
    private $uid = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name = '';

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=150, nullable=false)
     */
    private $url = '';

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     * 
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="state", type="boolean", nullable=false)
     */
    private $state = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="category", type="integer", nullable=false)
     */
    private $category = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="pr", type="boolean", nullable=false)
     */
    private $pr = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=200, nullable=false)
     */
    private $image = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="hits", type="integer", nullable=false)
     */
    private $hits = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="prio", type="boolean", nullable=false)
     */
    private $prio = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="vote", type="integer", nullable=false)
     */
    private $vote = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="broken", type="boolean", nullable=false)
     */
    private $broken = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    function getUid() {
        return $this->uid;
    }

    function getName() {
        return $this->name;
    }

    function getUrl() {
        return $this->url;
    }

    function getDescription() {
        return $this->description;
    }

    function getState() {
        return $this->state;
    }

    function getCategory() {
        return $this->category;
    }

    function getPr() {
        return $this->pr;
    }

    function getImage() {
        return $this->image;
    }

    function getHits() {
        return $this->hits;
    }

    function getPrio() {
        return $this->prio;
    }

    function getVote() {
        return $this->vote;
    }

    function getBroken() {
        return $this->broken;
    }

    function getEmail() {
        return $this->email;
    }

    function getDate(): \DateTime {
        return ($this->date) ?? new \DateTime();
    }

    function getId() {
        return $this->id;
    }

    function setUid($uid) {
        $this->uid = $uid;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setUrl($url) {
        $this->url = $url;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setState($state) {
        $this->state = $state;
    }

    function setCategory($category) {
        $this->category = $category;
    }

    function setPr($pr) {
        $this->pr = $pr;
    }

    function setImage($image) {
        if (is_null($image)) {
            $this->image = '';
        } else {
            $this->image = $image;
        }
    }

    function setHits($hits) {
        $this->hits = $hits;
    }

    function setPrio($prio) {
        $this->prio = $prio;
    }

    function setVote($vote) {
        $this->vote = $vote;
    }

    function setBroken($broken) {
        $this->broken = $broken;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setDate(\DateTime $date) {
        $this->date = $date;
    }

    function setId($id) {
        $this->id = $id;
    }

}
