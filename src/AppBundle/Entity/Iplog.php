<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Iplog
 *
 * @ORM\Table(name="iplog")
 * @ORM\Entity
 */
class Iplog
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="clic", type="boolean", nullable=false)
     */
    private $clic = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="vote", type="boolean", nullable=false)
     */
    private $vote = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date = '0000-00-00';

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=16)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $ip;

    /**
     * @var integer
     *
     * @ORM\Column(name="linkid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $linkid;

    function getClic() {
        return $this->clic;
    }

    function getVote() {
        return $this->vote;
    }

    function getDate(): \DateTime {
        return $this->date;
    }

    function getIp() {
        return $this->ip;
    }

    function getLinkid() {
        return $this->linkid;
    }

    function setClic($clic) {
        $this->clic = $clic;
    }

    function setVote($vote) {
        $this->vote = $vote;
    }

    function setDate(\DateTime $date) {
        $this->date = $date;
    }

    function setIp($ip) {
        $this->ip = $ip;
    }

    function setLinkid($linkid) {
        $this->linkid = $linkid;
    }


}

