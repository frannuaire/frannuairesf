<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Partner
 *
 * @ORM\Table(name="partner")
 * @ORM\Entity
 */
class Partner
{
    /**
     * @var string
     *
     * @ORM\Column(name="href", type="string", length=255, nullable=false)
     */
    private $href = '';

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=255, nullable=false)
     */
    private $label = '';

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title = '';

    /**
     * @var string
     *
     * @ORM\Column(name="lang", type="string", length=2, nullable=false)
     */
    private $lang = '';

    /**
     * @var string
     *
     * @ORM\Column(name="rel", type="string", length=255, nullable=true)
     */
    private $rel;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", nullable=false)
     */
    private $position = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="link_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $linkId;

    function getHref() {
        return $this->href;
    }

    function getLabel() {
        return $this->label;
    }

    function getTitle() {
        return $this->title;
    }

    function getLang() {
        return $this->lang;
    }

    function getRel() {
        return $this->rel;
    }

    function getPosition() {
        return $this->position;
    }

    function getLinkId() {
        return $this->linkId;
    }

    function setHref($href) {
        $this->href = $href;
    }

    function setLabel($label) {
        $this->label = $label;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setLang($lang) {
        $this->lang = $lang;
    }

    function setRel($rel) {
        $this->rel = $rel;
    }

    function setPosition($position) {
        $this->position = $position;
    }

    function setLinkId($linkId) {
        $this->linkId = $linkId;
    }


}

