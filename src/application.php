<?php

namespace App;

use App\Core\View;
use App\Core\Request;
use App\Core\Response;
use Bramus\Router\Router;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

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

    public Router $router;

    public Request $request;

    public Response $response;

    /**
     * Contructor function.
     *
     * @param array $config application config
     */
    public function __construct(array $config)
    {
        self::$app = $this;
        self::$path = $config['path'];

        $this->request = new Request([]);
        $this->response = new Response();
        $this->router = new Router;
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
}