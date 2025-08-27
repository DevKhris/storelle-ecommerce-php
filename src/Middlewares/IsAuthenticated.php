<?php

namespace App\Middlewares;

use Aura\Session\Session;

class IsAuthenticated
{
    private $sessionManager;

    public function __construct(Session $sessionManager)
    {
        $this->sessionManager = $sessionManager;
    }

    public function run()
    {
        $segment = $this->sessionManager->getSegment('auth');
        if (! $segment->get('is_valid')) {
            header("HTTP/1.1 401 Unathorized");
            header("Location: /login");
        } else {
            exit(1);
        }
    }
}