<?php

namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Site
 *
 * @ORM\Entity
 * @ORM\Table(name="site")
 */
class Site
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    public $uuid;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    public $baseUrl;

    /**
     * @ORM\OneToMany(targetEntity="Api\Entity\Journal", mappedBy="site", cascade={"all"})
     */
    public $journals;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->journals = new ArrayCollection();
    }

}
