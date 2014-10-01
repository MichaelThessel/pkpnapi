<?php

namespace Api;

use Api\Model\PKPBlog;

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

                'Api\Controller\Api' => function($cm)
                {
                    $sm = $cm->getServiceLocator();
                    $pkpBlog = $sm->get('PKPBlog');

                    return new Controller\ApiController($pkpBlog);
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

                'PKPBlog' => function($sm)
                {
                    $config = $sm->get('config');

                    return new PKPBlog($config['PKPBlog']['blogUrl']);
                },
            ),
        );
    }
}
