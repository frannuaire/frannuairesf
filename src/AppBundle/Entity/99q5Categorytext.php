<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 99q5Categorytext
 *
 * @ORM\Table(name="99q5_categorytext")
 * @ORM\Entity
 */
class 99q5Categorytext
{
    /**
     * @var integer
     *
     * @ORM\Column(name="catex_category", type="integer", nullable=false)
     */
    private $catexCategory;

    /**
     * @var string
     *
     * @ORM\Column(name="catex_text", type="text", length=65535, nullable=false)
     */
    private $catexText;

    /**
     * @var integer
     *
     * @ORM\Column(name="catex_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $catexId;


}

