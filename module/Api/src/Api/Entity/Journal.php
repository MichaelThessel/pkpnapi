<?php

namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Journal
 *
 * @ORM\Entity
 * @ORM\Table(name="journal")
 */
class Journal
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    protected $uuid;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $journalUrl;

    /**
     * @ORM\ManyToOne(targetEntity="Api\Entity\Site", cascade={"persist"})
     * @ORM\JoinColumn(name="site_uuid", referencedColumnName="uuid")
     */
    protected $site;
}
