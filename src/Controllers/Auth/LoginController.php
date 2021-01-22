<?php

namespace App\Controllers\Auth;

use App\Application;
use App\Core\Auth;
use App\Core\Request;

class LoginController
{
    /**
     * Index
     *
     * @param Request $req [request]
     *
     * @return [view]       [renders login]
     */
    public static function index(Request $req)
    {
        // if request was post then
        if ($req->onPost()) {
            return 'Logged in succesfully';
        }
        // renders the login view and returns it
        return Application::$app->router->view('login');
    }

    /**
     * handler for validate user session
     *
     * @return void
     */
    public static function login()
    {
        $auth = new Auth;
        return $auth->validate($_POST['username'], $_POST['password']);
    }
}
