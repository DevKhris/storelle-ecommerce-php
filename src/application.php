<?php

namespace App;

use App\Core\Router;
use App\Core\Request;
use App\Core\Response;

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
    /**
     * Contructor function
     *
     * @param string $path application path
     */
    public function __construct($path)
    {
        self::$app = $this;
        self::$path = $path;
        $this->req = new Request();
        $this->res = new Response();
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
        echo $this->router->resolve();
    }
}