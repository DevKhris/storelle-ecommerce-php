<?php

namespace App\Controllers\Auth;

use App\Core\Auth;
use App\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * Show login view.
     */
    public function index()
    {
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