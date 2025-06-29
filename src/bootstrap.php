
<?php

use App\Application;
use Mythos\Engine\View;
use DI\ContainerBuilder;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7Server\ServerRequestCreator;

$databaseConfig = require_once __DIR__ . '/../src/Config/database.php';
$applicationConfig = require_once __DIR__ . '/../src/Config/app.php';

$connection = DriverManager::getConnection([
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/db.sqlite',
], $databaseConfig['database']);

$entityManager = new EntityManager($connection, $databaseConfig['database']);

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    Application::class => new Application($applicationConfig),

    // Core
    RequestInterface::class => function () {
        $psr17Factory = new Psr17Factory();
        $creator = new ServerRequestCreator(
            serverRequestFactory: $psr17Factory, 
            uriFactory: $psr17Factory, 
            uploadedFileFactory: $psr17Factory, 
            streamFactory: $psr17Factory  
        );
        return $creator->fromGlobals();
    },
    ResponseInterface::class => function () {
        $psr17Factory = new Psr17Factory();
        return $psr17Factory->createResponse();
    },
    View::class => new View([
        'path' => realpath(__DIR__ . '/../resources/views/')
    ]),
    EntityManager::class => $entityManager,

    // Services
    App\Services\ProductService::class => new App\Services\ProductService($entityManager),

    // Controllers
    App\Controllers\HomeController::class => \DI\autowire(),
    App\Controllers\ProductController::class => \DI\autowire(),
    App\Controllers\ProductController::class => \DI\autowire(),
    App\Controllers\AboutController::class => \DI\autowire(),
    App\Controllers\ContactController::class => \DI\autowire(),
    App\Controllers\Auth\LoginController::class => \DI\autowire(),
]);

return $containerBuilder->build();