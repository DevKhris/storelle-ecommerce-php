<?php

namespace App\Controllers;

use App\Controllers\Controller;

/**
 *
 */
class AboutController extends Controller
{
    /**
     * Index function.
     */
    public function index()
    {
        return $this->view('about');
    }
}