<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 99q5Iplog
 *
 * @ORM\Table(name="99q5_iplog")
 * @ORM\Entity
 */
class 99q5Iplog
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="clic", type="boolean", nullable=false)
     */
    private $clic = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="vote", type="boolean", nullable=false)
     */
    private $vote = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date = '0000-00-00';

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=16)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $ip;

    /**
     * @var integer
     *
     * @ORM\Column(name="linkid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $linkid;


}

