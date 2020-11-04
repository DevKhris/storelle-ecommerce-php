<?php

namespace App\Core;

use App\Core\Request;

/**
 * Class Router
 * 
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 * @package namespace app\core;
 */

class Router
{
    // Request var
    public Request $req;
    // array of routes
    protected array $routes = [];

    // constructor function
    public function __construct(Request $req)
    {

        $this->req = $req;
    }

    /**
     * Get function
     *
     * @param [type] $path
     * @param [type] $callback
     * @return void
     */
    public function get($path, $callback)
    {
        // get's the path route and returns it's callback
        $this->routes['get'][$path] = $callback;
    }

    /**
     * Resolve function
     *
     * @return void
     */
    public function resolve()
    {
        $path = $this->req->getPath();
        $method = $this->req->getMethod();
    }

    // public static function Route()
    // {
    //     $this->request->getPath()
    //     $this->routes = [] = isset($_GET['p']) ? strtolower($_GET['p']) : "home";
    //     include_once __DIR__ . '\views\\' . $page . '.php';
    // }
}
