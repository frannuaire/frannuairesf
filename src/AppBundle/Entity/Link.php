<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * Link
 * @ApiResource(
 *     collectionOperations={"get"={"method"="GET"}},
 *     itemOperations={"get"={"method"="GET"}, "put"={"method"="PUT", "path"="/links/hits/{id}/update"}}
 * )
 * @ORM\Table(name="link")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LinkRepository")
 */
class Link {

    const HOME_ITEMS = 4;
    const LIST_ITEMS = 8;
     
    const STATE_PENDING = 1; // All link you need to valid or refused
    const STATE_BANNED = 2; // URL BANNED
    const STATE_TROUBLE = 3; // if is there some trouble with http statu when you check it 
    const STATE_VALID = 4; // All Valid Links
    
    const MIN_CARACT_VALIDATOR = 2; //change the default min number caract validator 
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
     * @var integer
     *
     * @ORM\Column(name="state", type="integer", nullable=false)
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
     *
     * @var type float
     * 
     * @ORM\Column(name="ratingvalue", type="float", nullable=false)
     */
    private $ratingValue = 0;


    
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
    

    
     public function __construct()
    {

    }
    function getRatingValue(): float {
        return $this->ratingValue;
    }

    function setRatingValue(float $ratingValue) {
        $this->ratingValue = $ratingValue;
    }
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
