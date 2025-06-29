<?php

namespace App\Middlewares;

class HasSession
{
    public function run()
    {
        if ($_SESSION['uid']) {
            header("Location: /dashboard");
            exit();
        }
    }
}