
<?php

use App\Application;
use App\Core\ConfigManager;
use Aura\Session\SessionFactory;
use Mythos\Engine\View;
use DI\ContainerBuilder;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;
use Nyholm\Psr7\Factory\Psr17Factory;
use PhpDevCommunity\DotEnv;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7Server\ServerRequestCreator;

$envPath =__DIR__ . '/../.env';

(new DotEnv($envPath))->load();

$sessionManager = (new SessionFactory)->newInstance($_COOKIE);
$configManager = new ConfigManager(__DIR__ . '/../src/Config/*.php');

$databaseConfig = $configManager->get('database');
$applicationConfig = $configManager->get('app');

$connection = DriverManager::getConnection([
    'driver' => $databaseConfig['driver'][getEnv('DATABASE_DRIVER')]['driver'],
    'user' => $databaseConfig['driver'][getEnv('DATABASE_DRIVER')]['user'],
    'password' => $databaseConfig['driver'][getEnv('DATABASE_DRIVER')]['password'],
    'dbname' => $databaseConfig['driver'][getEnv('DATABASE_DRIVER')]['dbname'],
], $databaseConfig['orm']);

$entityManager = new EntityManager($connection, $databaseConfig['orm']);

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    Application::class => new Application($applicationConfig),

    ConfigManager::class => $configManager,
    EntityManager::class => $entityManager,
    SessionFactory::class => $sessionManager,

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
    ], '.mythos'),

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