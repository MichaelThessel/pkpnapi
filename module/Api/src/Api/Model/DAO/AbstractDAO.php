<?php

namespace Api\Model\DAO;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

abstract class AbstractDAO implements ServiceLocatorAwareInterface
{
    protected $em;
    protected $sm;
    protected $repository;
    protected $repositoryName = '';

    public function __construct($em)
    {
        if (empty($this->repositoryName)) {
            throw new \Exception('Repository name is not set');
        }

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

    /**
     * Set the repository name
     *
     * @param string $repositoryName
     * @return void
     */
    public function setRepositoryName($repositoryName)
    {
        $this->repositoryName = $repositoryName;
    }
}
