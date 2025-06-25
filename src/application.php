<?php

namespace App;

use DI\Container;
use App\Core\View;
use App\Core\Request;
use App\Core\Response;
use DI\ContainerBuilder;
use Bramus\Router\Router;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;

/**
 * Application Class
 *
 * @package RubyNight\App;
 *
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 *
 */
class Application
{
    public static string $path;

    public static Application $app;

    public $connection;

    public $entityManager;

    public Container $container;

    public Router $router;

    public View $view;

    public Request $request;

    public Response $response;

    /**
     * Contructor function.
     *
     * @param string $path application path
     */
    public function __construct($path)
    {
        self::$app = $this;
        self::$path = $path;

        $this->request = new Request([]);
        $this->response = new Response();
        $this->router = new Router;
        $this->view = new View;
        $this->connection = DriverManager::getConnection([
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '/db.sqlite',
        ], $this->configDatabase());
        $this->entityManager = new EntityManager($this->connection, $this->configDatabase());
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions([
            EntityManager::class => $this->entityManager,
            View::class => $this->view,
        ]);
        $this->container = $containerBuilder->build();
    }

    /**
     * Exec to resolve callback
     *
     * @return bool executes callback from request
     */
    public function execute(): bool
    {
        return $this->router->run();
    }

    public function configDatabase(): Configuration
    {
        return ORMSetup::createXMLMetadataConfiguration(
            paths: [__DIR__ . '/Database/xml'],
            isDevMode: true,
        );
    }

}