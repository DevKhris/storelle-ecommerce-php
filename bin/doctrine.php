#!/usr/bin/env php
<?php
// bin/doctrine

require __DIR__ . '/../vendor/autoload.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

$container = require __DIR__ . '/../src/bootstrap.php';
$entityManager = $container->get('Doctrine\ORM\EntityManager');

return ConsoleRunner::run(
    new SingleManagerProvider($entityManager)
);