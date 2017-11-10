<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Keyword
 *
 * @ORM\Table(name="keyword")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\KeywordRepository")
 */
class Keyword
{
    /**
     * @var string
     *
     * @ORM\Column(name="word", type="string", length=200, nullable=false)
     */
    private $word;

    /**
     * @var integer
     *
     * @ORM\Column(name="occurence", type="integer", nullable=false)
     */
    private $occurence = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date = '0000-00-00';

    /**
     * @var boolean
     *
     * @ORM\Column(name="hasresults", type="boolean", nullable=false)
     */
    private $hasresults = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    function getWord() {
        return $this->word;
    }

    function getOccurence() {
        return $this->occurence;
    }

    function getDate(): \DateTime {
        return $this->date;
    }

    function getHasresults() {
        return $this->hasresults;
    }

    function getId() {
        return $this->id;
    }

    function setWord($word) {
        $this->word = $word;
    }

    function setOccurence($occurence) {
        $this->occurence = $occurence;
    }

    function setDate(\DateTime $date) {
        $this->date = $date;
    }

    function setHasresults($hasresults) {
        $this->hasresults = $hasresults;
    }

    function setId($id) {
        $this->id = $id;
    }


}

