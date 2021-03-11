<?php

namespace App\Core;

use App\Core\View;

abstract class Controller
{
    public function __construct()
    {
        $this->view = new View;
        $this->request = new Request;
        $this->response = new Response;
    }

    public function view($view, $params = [])
    {
        $this->view->view($view, $params);
    }
}