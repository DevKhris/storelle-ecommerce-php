<?php

/**
 * Class Router for basic routing and route handling
 *
 * @package RubyNight\App\Core;
 *
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */

namespace App\Core;

use App\Application;
use App\Core\Request;
use App\Core\Response;

class Router
{
    /** 
     * Associative array for routing table
     * 
     * @var array
     */
    protected $routes = array();

    /** 
     * Parameters from the route
     * 
     * @var array
     */
    protected $params = array();

    /** 
     * Constructor function
     *
     * @param Request  $req Request object
     * @param Response $res Response object
     * 
     * @return $this
     */
    public function __construct(Request $req, Response $res)
    {
        // instance of request object
        $this->req = $req;
        // instance of response object
        $this->res = $res;
        // return instance
        return $this;
    }

    /**
     * Get function
     *
     * @param string $path     uri path
     * @param string $callback callback
     *
     * @return $this
     */
    public function get($path, $callback)
    {
        // get's the path route and returns it's callback
        return $this->routes['get'][$path] = $callback;
    }

    /**
     * Post function
     *
     * @param string $path     uri path
     * @param string $callback callback
     *
     * @return $this
     */
    public function post($path, $callback)
    {
        // post's the path route and returns it's callback
        return $this->routes['post'][$path] = $callback;
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
        if ($callback == false) {
            $this->res->setStatus(404);
            return $this->view("404");
        }
        // if callback is a string
        if (is_string($callback)) {
            // return the view of the current callack
            return $this->view($callback);
        }
        // if is an array passes the callback index to self instance
        if (is_array($callback)) {
            $self[0] = new $callback[0];
        }
        // executes the user function from callback
        return call_user_func($callback, $this->req);
    }

    /**
     * Render view function
     * 
     * @param string $view view to render
     * 
     * @return string
     */
    public function view($view)
    {
        $content = $this->display();
        $view = $this->render($view);
        return str_replace('{{ display }}', $view, $content);
        include_once Application::$appPath . "/views/$view.php";
    }

    /**
     * Content function for rendering content to display placeholder
     * 
     * @param  string $content content to render
     * 
     * @return string
     */
    public function content($content)
    {
        $display = $this->display();
        return str_replace('{{ display }}', $content, $display);
    }

    protected function display()
    {
        \ob_start();
        include_once Application::$appPath . "/views/layout/main.php";
        return \ob_get_clean();
    }

    /**
     * Render function
     * 
     * @param string view
     * @param array parameters for view
     * 
     * @return object
     */
    protected function render($view, $params = [])
    {
        foreach ($params as $key => $value) {
            $key = $value;
        }
        \ob_start();
        include_once Application::$appPath . "/views/$view.php";
        return \ob_get_clean();
    }
}
