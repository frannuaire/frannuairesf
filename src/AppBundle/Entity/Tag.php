<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 99q5Tag
 *
 * @ORM\Table(name="99q5_tag")
 * @ORM\Entity
 */
class Tag
{
    /**
     * @var integer
     *
     * @ORM\Column(name="uid", type="integer", nullable=false)
     */
    private $uid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="string", length=255, nullable=false)
     */
    private $tag = '';

    /**
     * @var boolean
     *
     * @ORM\Column(name="approved", type="boolean", nullable=false)
     */
    private $approved = '1';

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

    function getTag() {
        return $this->tag;
    }

    function getApproved() {
        return $this->approved;
    }

    function getId() {
        return $this->id;
    }

    function setUid($uid) {
        $this->uid = $uid;
    }

    function setTag($tag) {
        $this->tag = $tag;
    }

    function setApproved($approved) {
        $this->approved = $approved;
    }

    function setId($id) {
        $this->id = $id;
    }



}

