<?php

namespace App\Middlewares;


class IsUserAuth
{
    public function __construct()
    {
        if ($_SESSION['auth'] === true) {
            return true;
        } else {
            header("Location: /login");
            exit();
        }
    }
}