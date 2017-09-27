<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 99q5Pub
 *
 * @ORM\Table(name="99q5_pub")
 * @ORM\Entity
 */
class 99q5Pub
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_emp", type="integer", nullable=false)
     */
    private $idEmp;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="text", length=65535, nullable=false)
     */
    private $code;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

