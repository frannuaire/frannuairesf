<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Validation
 *
 * @ORM\Table(name="validation")
 * @ORM\Entity
 */
class Validation
{
    /**
     * @var string
     *
     * @ORM\Column(name="secret", type="string", length=32, nullable=false)
     */
    private $secret = '';

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=70, nullable=false)
     */
    private $url = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=40, nullable=false)
     */
    private $email = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="id_site", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSite;
    
    function getSecret() {
        return $this->secret;
    }

    function getUrl() {
        return $this->url;
    }

    function getEmail() {
        return $this->email;
    }

    function getIdSite() {
        return $this->idSite;
    }

    function setSecret($secret) {
        $this->secret = $secret;
    }

    function setUrl($url) {
        $this->url = $url;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setIdSite($idSite) {
        $this->idSite = $idSite;
    }



}

