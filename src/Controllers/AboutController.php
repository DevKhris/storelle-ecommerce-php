<?php

namespace App\Controllers;

use App\Application;
use App\Core\Request;

/**
 *
 */
class AboutController
{
    /**
     * Index function
     *
     * @return view render view
     */
    public static function index()
    {
        // render view from router for about
        return Application::$app->router->view('about');
    }
}