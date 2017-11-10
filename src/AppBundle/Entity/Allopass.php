<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Allopass
 *
 * @ORM\Table(name="allopass")
 * @ORM\Entity
 */
class Allopass
{
    /**
     * @var string
     *
     * @ORM\Column(name="action", type="string", length=50, nullable=false)
     */
    private $action;

    /**
     * @var integer
     *
     * @ORM\Column(name="date", type="integer", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=15)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=8)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $code;

    function getAction() {
        return $this->action;
    }

    function getDate() {
        return $this->date;
    }

    function getIp() {
        return $this->ip;
    }

    function getCode() {
        return $this->code;
    }

    function setAction($action) {
        $this->action = $action;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setIp($ip) {
        $this->ip = $ip;
    }

    function setCode($code) {
        $this->code = $code;
    }


}

