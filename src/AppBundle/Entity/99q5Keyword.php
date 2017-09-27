<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 99q5Keyword
 *
 * @ORM\Table(name="99q5_keyword")
 * @ORM\Entity
 */
class 99q5Keyword
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


}

