<?php

namespace Api;

use Zend\Mvc\Controller\ControllerManager;
use Zend\ServiceManager\ServiceManager;

use Api\Model\PKPBlog;
use Api\Model\DataHandler;
use Api\Model\DAO\SiteDAO;
use Api\Model\DAO\JournalDAO;
use Api\Controller\ApiController;

class Module
{
    /**
     * Get config
     *
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * Get autoloader config
     *
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php'
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * Get controller config
     *
     * @return array
     */
    public function getControllerConfig()
    {
        return array(
            'factories' => array(

                'Api\Controller\Api' => function(ControllerManager $cm)
                {
                    $sm = $cm->getServiceLocator();
                    $pkpBlog = $sm->get('PKPBlog');
                    $dataHandler = $sm->get('DataHandler');

                    return new ApiController($pkpBlog, $dataHandler);
                },

            )
        );
    }

    /**
     * Get service config
     *
     * @return array
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(

                'PKPBlog' => function(ServiceManager $sm)
                {
                    $config = $sm->get('config');
                    $dataHandler = $sm->get('DataHandler');

                    return new PKPBlog(
                        $config['PKPBlog']['blogUrl'],
                        $dataHandler
                    );
                },

                'DataHandler' => function(ServiceManager $sm)
                {
                    $em = $sm->get('doctrine.entitymanager.orm_default');
                    $siteDAO = $sm->get('SiteDAO');
                    $journalDAO = $sm->get('JournalDAO');

                    return new DataHandler($siteDAO, $journalDAO);
                },

                'SiteDAO' => function(ServiceManager $sm)
                {
                    $em = $sm->get('doctrine.entitymanager.orm_default');

                    return new SiteDAO($em);
                },

                'JournalDAO' => function(ServiceManager $sm)
                {
                    $em = $sm->get('doctrine.entitymanager.orm_default');

                    return new JournalDAO($em);
                },
            ),
            'invokables' => array(
                'Api\Entity\Site' => 'Api\Entity\Site',
                'Api\Entity\Journal' => 'Api\Entity\Journal',
            ),
            'shared' => array(
                'Api\Entity\Site' => false,
                'Api\Entity\Journal' => false,
            ),
        );
    }
}
