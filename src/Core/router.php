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
    // Response var
    public Response $res;
    // array of routes
    protected array $routes = [];

    /** Constructor function
     *
     * @param \app\core\Request $req
     * @param \app\core\Response $res
     */
    public function __construct($req, $res)
    {
        // instance of request object
        $this->req = $req;

        // instance of response object
        $this->res = $res;
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
     * @param Callback $callback
     * @return void
     */
    public function set($path, $callback)
    {
        // post's the path route and returns it's callback
        $this->routes['post'][$path] = $callback;
    }

    /**
     * Resolve function
     *
     * @return void
     */
    public function resolve()
    {
        // get path from request
        $path = $this->req->getPath();
        // get pmethod from request
        $method = $this->req->getMethod();

        // get the route method and path or return false
        $callback = $this->routes[$method][$path] ?? false;

        // if not callback then return and 404 state and display view
        if ($callback === false) {
            $this->res->setStatus(404);
            return $this->renderView("404");
        }
        // if callback is a string
        if (is_string($callback)) {
            // return the view of the current callack
            return $this->renderView($callback);
        }
        // if is an array passes the callback index to self instance
        if (is_array($callback)) {
            $self[0] = new $callback[0];
        }
        // executes the user function from callback
        return call_user_func($callback, $this->req);
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

    public function renderContent($viewContent)
    {
        $displayContent = $this->displayContent();
        return str_replace('{{display}}', $viewContent, $displayContent);
    }

    protected function displayContent()
    {
        \ob_start();
        include_once Application::$appPath . "/views/layout/main.php";
        return \ob_get_clean();
    }

    protected function renderOneView($view, $params = [])
    {
        foreach ($params as $key => $value) {
            $key = $value;
        }
        \ob_start();
        include_once Application::$appPath . "/views/$view.php";
        return \ob_get_clean();
    }
}
