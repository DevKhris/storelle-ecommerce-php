<?php

namespace App\Controllers\Auth;

use App\Core\Auth;
use App\Core\Controller;

class LoginController extends Controller
{
    /**
     * Index
     *
<<<<<<< HEAD
     * @return view
=======
     * @param Request $req request
     *
     * @return view       
>>>>>>> 740271422a62dbe7959ac68ebbebd9c15ba3d9a9
     */
    public function index()
    {
        // renders the login view and returns it
<<<<<<< HEAD
        $this->view('login');
=======
        return Application::$app->router->view('auth.login');
>>>>>>> 740271422a62dbe7959ac68ebbebd9c15ba3d9a9
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