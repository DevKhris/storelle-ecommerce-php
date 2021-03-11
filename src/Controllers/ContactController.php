<?php

namespace App\Controllers;

use App\Application;
use App\Core\Controller;
use App\Core\Request;

class ContactController extends Controller
{
    /**
     * Index resource 
     *
     * @return view render view
     */
    public function index()
    {
        // render view from router for contact
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
        // get body from requests
        $body = $req->getBody();
        // return body
        return $body;
    }
}