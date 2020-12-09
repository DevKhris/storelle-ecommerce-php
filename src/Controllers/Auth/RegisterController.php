<?php

/**
 * Class AuthController for authentication
 *
 * @package RubyNight\App\Controllers;
 *
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */

namespace App\Controllers\Auth;

use App\Application;
use App\Core\Auth;
use App\Core\Request;

class RegisterController
{
    public $username;
    public $password;

     /**
     * [register callback]
     *
     * @param Request $req [request]
     *
     * @return [view]       [renders register]
     */
    public static function index(Request $req)
    {
        if ($req->onPost()) {
            return 'Register succesfully';
        }
        return Application::$app->router->renderView('register');
    }

    /**
     * [callback handler for handling user register]
     *
     * @return [string] [validation]
     */
    public static function register()
    {
        Auth::register();
    }
}
