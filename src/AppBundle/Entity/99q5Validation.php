<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 99q5Validation
 *
 * @ORM\Table(name="99q5_validation")
 * @ORM\Entity
 */
class 99q5Validation
{
    /**
     * @var string
     *
     * @ORM\Column(name="secret", type="string", length=32, nullable=false)
     */
    private $secret = '';

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=70, nullable=false)
     */
    private $url = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=40, nullable=false)
     */
    private $email = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="id_site", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSite;


}

