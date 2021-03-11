<?php

namespace App\Controllers\Auth;

use App\Core\Auth;
use App\Core\Controller;

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
        $this->view('login');
    }

    /**
     * Validate user
     *
     * @return void
     */
    public function login()
    {
        $auth = new Auth;
        return $auth->validate($_POST['username'], $_POST['password']);
    }
}