<?php

namespace App\Middlewares;

use Aura\Session\Session;

class IsAuthenticated
{
    private Session $sessionManager;

    public function __construct(Session $sessionManager)
    {
        $this->sessionManager = $sessionManager;
    }

    public function handle()
    {
        $segment = $this->sessionManager->getSegment('auth');
        $isValid = $segment->get('isValid', false);

        if (! $isValid) {
            header("HTTP/1.1 401 Unathorized");
            header("location: /login");
            exit;
        } 
    }
}