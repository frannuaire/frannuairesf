<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 99q5Link2tag
 *
 * @ORM\Table(name="99q5_link2tag")
 * @ORM\Entity
 */
class 99q5Link2tag
{
    /**
     * @var integer
     *
     * @ORM\Column(name="lid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $lid;

    /**
     * @var integer
     *
     * @ORM\Column(name="tid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $tid;


}

