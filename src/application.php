<?php

namespace App;

use App\Core\Router;
use App\Core\Request;
use App\Core\Response;

/**
 * Class MainController for handling rendering and callbacks
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
    /**
     * Contructor function
     *
     * @param string $appPath param of application path
     */
    public function __construct($path)
    {
        // self instance and application path
        self::$app = $this;
        self::$path = $path;
        // new request instance
        $this->req = new Request();
        // new response instance
        $this->res = new Response();
        // new router instance
        $this->router = new Router($this->req, $this->res);

        return $this;
    }

    /**
     * Exec to resolve callback
     *
     * @return callback executes callback from request
     */
    public function execute()
    {
        // returns resolve
        echo $this->router->resolve();
    }
}
