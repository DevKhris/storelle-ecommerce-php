<?php

namespace App\Middlewares;

class IsAuthenticated
{
    public function run()
    {
        if (!isset($_SESSION['uid'])) {
            header("HTTP/1.1 401 Unathorized");
            header("Location: /login");
        } else {
            exit(1);
        }
    }
}