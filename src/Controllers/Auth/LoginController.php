<?php

namespace App\Controllers\Auth;

use App\Core\Auth;
use App\Controllers\Controller;
use App\Services\AuthService;
use Psr\Http\Message\ServerRequestInterface;


class LoginController extends Controller
{
    /**
     * Show login view.
     */
    public function index()
    {
        $this->view('auth.login');
    }

    /**
     * handler for validate user session.
     */
    public function login(AuthService $authService, ServerRequestInterface $request)
    {
        $data = $request->getParsedBody();
        $isLogged = $authService->validate($data);

        if ($isLogged) {
            header('location: \dashboard');
            exit;
        };

        header('location: \login'); 
    }

     /**
     * handling logout.
     */
    public function logout(AuthService $authService)
    {
        $authService->logout();
        header('Location: \login');
    }
}