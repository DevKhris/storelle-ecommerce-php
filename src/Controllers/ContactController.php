<?php

namespace App\Controllers;

use App\Controllers\Controller;
use Psr\Http\Message\RequestInterface;

class ContactController extends Controller
{
    /**
     * Index resource 
     *
     * @return View render view
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
    public function create(RequestInterface $request)
    {
        $body = $request->getBody();
        return $body;
    }
}