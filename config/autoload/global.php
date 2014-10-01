<?php

return array(
    'PKPBlog' => array(
        'blogUrl' => 'https://pkp.sfu.ca/',
    ),
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host' => 'localhost',
                    'user' => '',
                    'password' => '',
                    'dbname' => '',
                    'charset' => 'utf8',
                    'driverOptions' => array(1002 => 'SET NAMES utf8')
                ),
            ),
        ),
    ),
);
