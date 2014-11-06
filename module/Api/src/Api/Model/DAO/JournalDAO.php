<?php

namespace Api\Model\DAO;

use Api\Model\DAO\AbstractDAO;

class JournalDAO extends AbstractDAO
{
    public function __construct($em)
    {
        $this->setRepositoryName('Api\Entity\Journal');

        parent::__construct($em);
    }
}
