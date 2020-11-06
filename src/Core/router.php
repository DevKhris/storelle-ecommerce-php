<?php

namespace App\Core;

use App;
use App\Application;
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

    /** Constructor function
     * 
     */
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
     * Set function
     *
     * @param [type] $callback
     * @return void
     */
    // public function set(callback)
    // {
    //    
    // }

    /**
     * Resolve function
     *
     * @return void
     */
    public function resolve()
    {
        $path = $this->req->getPath();
        $method = $this->req->getMethod();

        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            return $this->renderView("404");
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        return call_user_func($callback);
    }

    /**
     * Render View function
     * @param [type] $view
     * @return void
     */
    public function renderView($view)
    {
        $displayContent = $this->displayContent();
        $viewContent = $this->renderOneView($view);
        return str_replace('{{display}}', $viewContent, $displayContent);

        include_once Application::$appPath . "/views/$view.php";
    }

    protected function displayContent()
    {
        \ob_start();
        include_once Application::$appPath . "/views/layout/main.php";
        return \ob_get_clean();
    }

    protected function renderOneView($view)
    {
        \ob_start();
        include_once Application::$appPath . "/views/$view.php";
        return \ob_get_clean();
    }
}
