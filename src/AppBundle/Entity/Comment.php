<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Link as Link;

/**
 * 99q5Comment
 *
 * @ORM\Table(name="99q5_comment")
 * @ORM\Entity
 */
class Comment {

    const TO_APPROVE = 0;
    const APPROVED = 1;

    /**
     *  @var integer
     *  @ORM\Column(name="lid", type="integer", nullable=false)
     */
    private $lid;

    /**
     * @var integer
     *
     * @ORM\Column(name="uid", type="integer", nullable=false)
     */
    private $uid;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", length=65535, nullable=false)
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var boolean
     *
     * @ORM\Column(name="approved", type="boolean", nullable=false)
     */
    private $approved = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Link",  inversedBy="comments")
     * @ORM\JoinColumn(name="lid", referencedColumnName="id")
     */
    private $link;

    public function getLink() {
        return $this->link;
    }

    public function setLink(Link $link) {
        $this->link = $link;
    }

    function getLid() {
        return $this->lid;
    }

    function getUid() {
        return $this->uid;
    }

    function getMessage() {
        return $this->message;
    }

    function getDate(): \DateTime {
        return $this->date;
    }

    function getApproved() {
        return $this->approved;
    }

    function getId() {
        return $this->id;
    }

    function setLid($lid) {
        $this->lid = $lid;
    }

    function setUid($uid) {
        $this->uid = $uid;
    }

    function setMessage($message) {
        $this->message = $message;
    }

    function setDate(\DateTime $date) {
        $this->date = $date;
    }

    function setApproved($approved) {
        $this->approved = $approved;
    }

    function setId($id) {
        $this->id = $id;
    }

}
