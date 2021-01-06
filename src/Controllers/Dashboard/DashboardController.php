<?php

namespace App\Controllers\Dashboard;

use App\Application;
use App\Core\Request;
use App\Core\User;
use App\Core\getBalance;

class DashboardController
{
    public static function index()
    {
        return Application::$app->router->view('dashboard');
    }

    /**
     * [get for profile requests]
     *
     * @return [array] [request]
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
     * @return [header] [returns user to login]
     */
    public function logout()
    {
        // set logged to false
        $_SESSION['loggedin'] = false;

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
        // end
        die;
    }
}