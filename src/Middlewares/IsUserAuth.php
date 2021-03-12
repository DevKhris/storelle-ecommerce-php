<?php

namespace App\Middlewares;


class IsUserAuth
{
    public function run()
    {
        if (!$_SESSION['auth']) {
            header("Location: /login");
            exit();
        }
    }
}