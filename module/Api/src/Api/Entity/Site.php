<?php

namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;

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
    protected $uuid;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $baseUrl;

    /**
     * @ORM\OneToMany(targetEntity="Api\Entity\Journal", mappedBy="site", cascade={"all"})
     */
    protected $journals;
}
