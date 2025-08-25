<?php

namespace App\Services;

class AuthService
{
    public function login(SessionFactory $sessionFactory, User $user, array $data)
    {
        $segment = $sessionFactory->getSegment('user');
        
        
    }
}