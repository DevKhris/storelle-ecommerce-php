<?php

namespace App\Controllers;

use App\Core\Request;
use App\Controllers\Controller;

class ContactController extends Controller
{
    /**
     * Index resource 
     *
     * @return view render view
     */
    public function index()
    {
        return $this->view('contact');
    }

    /**
     * Create contact resource
     * @param Request $req request object
     *
     * @return array $body 
     */
    public function create(Request $req)
    {
        $body = $req->getBody();
        return $body;
    }
}