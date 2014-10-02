<?php

namespace Api\Model\DAO;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SiteDAO implements ServiceLocatorAwareInterface
{
    protected $em;
    protected $sm;
    protected $repository;
    protected $repositoryName = 'Api\Entity\Site';

    public function __construct ($em)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository($this->repositoryName);
    }

    /**
     * Set the service locator
     *
     * @param ServiceLocatorInterface $sm
     *
     * @return void
     */
    public function setServiceLocator(ServiceLocatorInterface $sm)
    {
        $this->sm = $sm;
    }

    /**
     * Get the service locator
     *
     * @return ServiceLocator ServiceLocator instance
     */
    public function getServiceLocator()
    {
        return $this->sm;
    }

    /**
     * Get the repository
     *
     * @return mixed Repository instance
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * Get the entity manager
     *
     * @return mixed Entiry manager instance
     */
    public function getEntityManager()
    {
        return $this->em;
    }

    /**
     * Returns a new instance
     *
     * @return mixed Instance
     */
    public function getInstance()
    {
        // Retrieve the instance from the service manager
        return $this->sm->get($this->repositoryName);
    }
}
