<?php

/**

 */

namespace App\Controllers;

use App\Application;
use App\Core\Request;
use App\Core\User;

class HomeController
{
    /**
     * Index function
     *
     * @return view render view
     */
    public static function index()
    {
        // render view from router for home
        return Application::$app->router->view('home');
    }
}