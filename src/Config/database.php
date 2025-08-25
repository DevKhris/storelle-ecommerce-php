<?php

use Doctrine\ORM\ORMSetup;

return [
    'orm' => ORMSetup::createAttributeMetadataConfiguration(
        paths: [realpath(__DIR__ . '/../Models')],
        isDevMode: true,
    ),

    'driver' => [
        'sqlite' => [
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '/db.sqlite',
        ],
        'mysql' => [
            'driver' => 'pdo_mysql',
            'dbname' => getenv('DATABASE_NAME'),
            'user' => getenv('DATABASE_USER'),
            'password' => getenv('DATABASE_PASSWORD')
        ]
    ]
];