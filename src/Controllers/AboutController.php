<?php

namespace App\Controllers;

use App\Core\Controller;

/**
 *
 */
class AboutController extends Controller
{
    /**
     * Index function
     *
     * @return view render view
     */
    public function index()
    {
        // render view from router for about
        return $this->view('about');
    }
}