<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 99q5Feed
 *
 * @ORM\Table(name="99q5_feed")
 * @ORM\Entity
 */
class 99q5Feed
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


}

