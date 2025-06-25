<?php

namespace App\Controllers\Auth;

use App\Core\Auth;
use App\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * Index
     *
     * @return view
     */
    public function index()
    {
        // renders the login view and returns it
        $this->view('auth.login');
    }

    /**
     * handler for validate user session
     *
     * @return void
     */
    public function login()
    {
        $auth = new Auth;
        return $auth->validate($_POST['username'], $_POST['password']);
    }
}