<?php

namespace App\Core;

class Auth
{
    public function logoutUser()
    {
        if (\session_destroy()) {
            header('Location: \login');
        }
        \session_unset();
        \session_abort();
        header('Location: \login');
    }
}
