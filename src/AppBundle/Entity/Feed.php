<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Feed
 *
 * @ORM\Table(name="feed")
 * @ORM\Entity
 */
class Feed
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="linkid", type="integer", nullable=false)
     */
    private $linkid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="feed", type="string", length=255, nullable=false)
     */
    private $feed = '';

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

    function getLinkid() {
        return $this->linkid;
    }

    function getFeed() {
        return $this->feed;
    }

    function getId() {
        return $this->id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setLinkid($linkid) {
        $this->linkid = $linkid;
    }

    function setFeed($feed) {
        $this->feed = $feed;
    }

    function setId($id) {
        $this->id = $id;
    }


}

