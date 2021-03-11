<?php

/**

 */

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller
{
    /**
     * Index function
     *
     * @return view render view
     */
    public function index()
    {
        // render view from router for home
        return $this->view('home');
    }
}