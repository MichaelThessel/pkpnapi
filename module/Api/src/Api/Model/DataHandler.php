<?php

namespace Api\Model;

use Api\Model\DAO\SiteDAO;
use Api\Model\DAO\JournalDAO;

class DataHandler
{
    protected $siteDAO;
    protected $journalDAO;

    public function __construct(SiteDAO $siteDAO, JournalDAO $journalDAO)
    {
        $this->siteDAO = $siteDAO;
        $this->journalDAO = $journalDAO;
    }

    public function store()
    {
    }
}
