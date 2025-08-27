<?php

namespace App\Controllers;

use App\Controllers\Controller;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;

class ContactController extends Controller
{
    /**
     * Index resource .
     */
    public function index()
    {
        return $this->view('contact');
    }

    /**
     * Create contact resource
     * @param RequestInterface $request request object
     *
     * @return array $body 
     */
    public function create(RequestInterface $request): StreamInterface
    {
        $body = $request->getBody();
        return $body;
    }
}