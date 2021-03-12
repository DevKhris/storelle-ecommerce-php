<?php

namespace App\Middlewares;

class IsUserSession
{
    public function run()
    {
        if ($_SESSION['auth']) {
            header("Location: /dashboard");
            exit();
        }
    }
}