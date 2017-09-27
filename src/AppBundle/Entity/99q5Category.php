<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 99q5Category
 *
 * @ORM\Table(name="99q5_category")
 * @ORM\Entity
 */
class 99q5Category
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="root", type="integer", nullable=false)
     */
    private $root = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="usable", type="boolean", nullable=false)
     */
    private $usable = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

