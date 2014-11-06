<?php

namespace Api\Model\DAO;

use Api\Model\DAO\AbstractDAO;

class SiteDAO extends AbstractDAO
{
    public function __construct($em)
    {
        $this->setRepositoryName('Api\Entity\Site');
        parent::__construct($em);
    }
}
