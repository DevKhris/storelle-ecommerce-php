<?php

namespace App\Controllers\Dashboard;

use App\Application;
use App\Core\Request;
use App\Core\User;
use App\Core\getBalance;

class DashboardController
{
    /**
     * Index function
     *
     * @return void
     */
    public static function index()
    {
        return Application::$app->router->view('dashboard');
    }

    /**
     * Get for profile requests
     *
     * @return array request
     */
    public static function get()
    {
        $res = [];
        // get balance from current user in session and store
        $res = User::getBalance($_SESSION['name']);
        // return response
        return $res;
    }

    /**
     * [callback for handling logout]
     *
     * @return void
     */
    public function logout()
    {
        // set logged to false
        $_SESSION['auth'] = false;

        // if the session is destroyed returns to login and ends
        if (\session_destroy()) {
            header('Location: \login');
            die;
        }
        // unsets the session
        \session_unset();
        // aborts session
        \session_abort();
        // returns to login
        header('Location: \login');
    }
}
