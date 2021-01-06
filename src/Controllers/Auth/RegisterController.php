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
    public $auth;

    public function __construct()
    {
        return $this;
    }
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
        return Application::$app->router->view('register');
    }

    /**
     * [callback handler for handling user register]
     *
     * @return [string] [validation]
     */
    public static function register()
    {
        $auth = new Auth;
        $auth->register($_POST['username'], $_POST['password']);
    }
}