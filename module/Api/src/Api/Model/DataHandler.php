<?php

namespace Api\Model;

use Api\Model\DAO\SiteDAO;
use Api\Model\DAO\JournalDAO;

class DataHandler
{
    protected $siteDAO;
    protected $journalDAO;
    protected $data;

    public function __construct(SiteDAO $siteDAO, JournalDAO $journalDAO)
    {
        $this->siteDAO = $siteDAO;
        $this->journalDAO = $journalDAO;
    }

    /**
     * Set the data to store
     *
     * @param mixed $data Data to store
     * @return void
     */
    public function setData($data)
    {
        assert(is_array($data));

        $this->data = $data;
    }

    /**
     * Validate the data
     *
     * @param mixed $message Error message
     * @return bool Whether or not the data is valid
     */
    public function validate(&$message)
    {
        if (empty($this->data)) {
            $message = 'Invalid data';
            return false;
        }

        // Validate site data is set
        if (!isset($this->data['uuid']) || !isset($this->data['baseUrl'])) {
            $message = 'Incomplete site data';
            return false;
        }

        // Validate journal data
        if (isset($this->data['journals'])) {
            if (!is_array($this->data['journals'])) {
                $message = 'Invalid Journal data';
                return false;
            }

            foreach ($this->data['journals'] as $journal) {
                if (!isset($journal['uuid']) || !isset($journal['journalUrl'])) {
                    $message = 'Invalid Journal data';
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Store the data
     *
     * @return void
     */
    public function store()
    {
        $siteRepository = $this->siteDAO->getRepository();
        $journalRepository = $this->journalDAO->getRepository();

        if (!($site = $siteRepository->findOneBy(array('uuid' => $this->data['uuid'])))) {
            $site = $this->siteDAO->getInstance();
        }

        $site->uuid = $this->data['uuid'];
        $site->baseUrl = $this->data['baseUrl'];

        $this->siteDAO->getEntityManager()->persist($site);

        if (isset($this->data['journals'])) {
            foreach($this->data['journals'] as $journalData) {
                if (!($journal = $journalRepository->findOneBy(array('uuid' => $journalData['uuid'])))) {
                    $journal = $this->journalDAO->getInstance();
                }

                $journal->uuid = $journalData['uuid'];
                $journal->journalUrl = $journalData['journalUrl'];

                $site->journals->add($journal);
            }
        }

        $this->siteDAO->getEntityManager()->flush();
    }
}
