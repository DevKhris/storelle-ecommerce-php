<?php

namespace App\Controllers\Dashboard;

use App\Core\Controller;

class DashboardController extends Controller
{
    /**
     * Index function
     *
     * @return void
     */
    public function index()
    {
        $this->view('user.dashboard.index');
    }

    /**
     * Get for profile requests
     *
     * @return array request
     */
    public function show()
    {
        // get balance from current user in session and store
        $res = $_SESSION['balance'];
        // return response
        echo $res;
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