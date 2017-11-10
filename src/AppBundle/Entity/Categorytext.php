<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorytext
 *
 * @ORM\Table(name="categorytext")
 * @ORM\Entity
 */
class Categorytext
{
    /**
     * @var integer
     *
     * @ORM\Column(name="catex_category", type="integer", nullable=false)
     */
    private $catexCategory;

    /**
     * @var string
     *
     * @ORM\Column(name="catex_text", type="text", length=65535, nullable=false)
     */
    private $catexText;

    /**
     * @var integer
     *
     * @ORM\Column(name="catex_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $catexId;
    
    function getCatexCategory() {
        return $this->catexCategory;
    }

    function getCatexText() {
        return $this->catexText;
    }

    function getCatexId() {
        return $this->catexId;
    }

    function setCatexCategory($catexCategory) {
        $this->catexCategory = $catexCategory;
    }

    function setCatexText($catexText) {
        $this->catexText = $catexText;
    }

    function setCatexId($catexId) {
        $this->catexId = $catexId;
    }



}

