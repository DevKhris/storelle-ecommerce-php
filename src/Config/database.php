<?php

use Doctrine\ORM\ORMSetup;

return [
    'database' => ORMSetup::createAttributeMetadataConfiguration(
        paths: [realpath(__DIR__ . '/../Models')],
        isDevMode: true,
    ),
];