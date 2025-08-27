<?php

/**
 * Class AuthController for authentication
 *
 * @package RubyNight\App\Controllers;
 *
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */

namespace App\Controllers\Auth;

use App\Core\Auth;
use App\Controllers\Controller;
use App\Services\AuthService;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ServerRequestInterface;

class RegisterController extends Controller
{
    /**
     * Index function

     */
    public function index()
    {
        $this->view('auth.register');
    }

    /**
     * User register
     */
    public function register(AuthService $authService, ServerRequestInterface $request): void
    {
        $data = $request->getParsedBody();
        $result = $authService->register($data);
        die();
        if ($result) {
            header('location: \\');
        }
    }
}