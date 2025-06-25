<?php

use Doctrine\ORM\ORMSetup;

return [
    'path' => realpath(dirname('../..')),
    'url' => "http://localhost/",
    'database' => ORMSetup::createXMLMetadataConfiguration(
        paths: [__DIR__ . '/Database/xml'],
        isDevMode: true,
    ),
];