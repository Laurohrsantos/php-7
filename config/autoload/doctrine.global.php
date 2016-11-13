<?php

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMysql\Driver',
                'params' => [
                    'host' => 'localhost',
                    'port' => '3306',
                    'user' => 'homestead',
                    'password' => 'secret',
                    'dbname' => 'codemailmkt',
                    'driverOptions' => [
                        \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES `UTF8`"
                    ]
                ]
            ]
        ],
        'driver' => [
            'CodeEmailMKT_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [__DIR__ . '/../../src/CodeEmailMKT/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    'CodeEmailMKT\Entity' => 'CodeEmailMKT_driver'
                ]
            ]
        ]
    ]
];