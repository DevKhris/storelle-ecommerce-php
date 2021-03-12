<?php

/**
 * Class AuthController for authentication
 *
 * @package RubyNight\App\Controllers;
 *
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */

namespace App\Controllers\Auth;

use App\Core\Auth;
use App\Core\Controller;

class RegisterController extends Controller
{
    public $auth;

    /**
     * Index function
     *
     *
     * @return view    
     */
    public function index()
    {
        $this->view('auth.register');
    }

    /**
     * User register
     *
     * @return 
     */
    public function register()
    {
        $auth = new Auth;
        $auth->register($_POST['username'], $_POST['password']);
    }
}