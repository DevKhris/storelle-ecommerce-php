<?php

/**

 */

namespace App\Controllers;

use App\Core\View;
use App\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Index function
     *
     * @return View render view
     */
    public function index()
    {
        // render view from router for home
        return $this->view('home');
    }
}