
<?php

use App\Core\View;
use App\Application;
use DI\ContainerBuilder;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;
use App\Controllers\HomeController;
use App\Controllers\AboutController;
use App\Controllers\ContactController;
use App\Controllers\ProductController;
use App\Controllers\ProductsController;

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

        // CVontrollers
    HomeController::class => \DI\autowire(),
    ProductController::class => \DI\autowire(),
    ProductsController::class => \DI\autowire(),
    AboutController::class => \DI\autowire(),
    ContactController::class => \DI\autowire(),
]);

return $containerBuilder->build();