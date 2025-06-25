
<?php

use App\Application;
use DI\ContainerBuilder;
use App\Core\View;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;

$config = require __DIR__ . '/../src/Core/config.php';
$connection = DriverManager::getConnection([
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/db.sqlite',
], $config['database']);

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    EntityManager::class => new EntityManager($connection, $config['database']),
    View::class => new View(),

    Application::class => new Application($config),
]);

return $containerBuilder->build();