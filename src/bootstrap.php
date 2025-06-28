
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

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    Application::class => new Application($applicationConfig),

        // Core
    EntityManager::class => new EntityManager($connection, $databaseConfig['database']),
    View::class => new View([
        'path' => realpath(__DIR__ . '/../resources/views/')
    ]),
    RequestInterface::class => function () {
        $psr17Factory = new Psr17Factory();
        $creator = new ServerRequestCreator(
            $psr17Factory, // ServerRequestFactory
            $psr17Factory, // UriFactory
            $psr17Factory, // UploadedFileFactory
            $psr17Factory  // StreamFactory
        );
        return $creator->fromGlobals();
    },
    ResponseInterface::class => function () {
        $psr17Factory = new Psr17Factory();
        return $psr17Factory->createResponse();
    },

    // Controllers
    App\Controllers\HomeController::class => \DI\autowire(),
    App\Controllers\ProductController::class => \DI\autowire(),
    App\Controllers\ProductsController::class => \DI\autowire(),
    App\Controllers\AboutController::class => \DI\autowire(),
    App\Controllers\ContactController::class => \DI\autowire(),
]);

return $containerBuilder->build();