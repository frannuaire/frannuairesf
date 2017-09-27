<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 99q5In
 *
 * @ORM\Table(name="99q5_in")
 * @ORM\Entity
 */
class 99q5In
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ins", type="integer", nullable=false)
     */
    private $ins;

    /**
     * @var integer
     *
     * @ORM\Column(name="uid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $uid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $date;


}

