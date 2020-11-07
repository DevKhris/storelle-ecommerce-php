<?php

namespace App\Core;

use App\Model\BaseUser;
use App\Core\User;
use APp\Core\Router;

class Auth
{
    public BaseUser $user;
    public $username;
    public $password;
    public $session;
    /**
     *  Checks if the user is currently logged and returns result
     * @return bool
     **/
    public static function checkLogin()
    {
        $session = $_SESSION;
        if (empty($session)) {
            return false;
        } else {
            return true;
        }
    }

    public function logoutUser()
    {
        if (\session_destroy()) {
            header('Location: \login');
        } else {
            \session_unset();
            \session_abort();
            header('Location: \login');
        }
    }
}
