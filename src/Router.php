<?php

namespace App;

class Router
{
    public $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }
    public static function Route()
    {
        $this-> = isset($_GET['p']) ? strtolower($_GET['p']) : "home";
        require_once __DIR__ . '\views\\' . $page . '.php';
    }
}