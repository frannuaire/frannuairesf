<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 99q5User
 *
 * @ORM\Table(name="99q5_user")
 * @ORM\Entity
 */
class 99q5User
{
    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=33, nullable=false)
     */
    private $login = '';

    /**
     * @var string
     *
     * @ORM\Column(name="pass", type="string", length=33, nullable=false)
     */
    private $pass = '';

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    private $email = '';

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="isadmin", type="boolean", nullable=false)
     */
    private $isadmin = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="points", type="integer", nullable=false)
     */
    private $points = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

