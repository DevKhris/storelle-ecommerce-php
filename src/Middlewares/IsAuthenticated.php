<?php

namespace App\Middlewares;

class IsAuthenticated
{
    public function run(SessionFactory $sessionFactory)
    {
        $segment = $sessionFactory->getSement('auth');
        if (!$segment->get('is_valid')) {
            header("HTTP/1.1 401 Unathorized");
            header("Location: /login");
        } else {
            exit(1);
        }
    }
}