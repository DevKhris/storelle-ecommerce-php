<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Request;
use App\Core\Response;

abstract class Controller
{
    public View $view;

    public Request $request;

    public Response $response;

    public function __construct(View $view)
    {
        $this->view = $view;
        $this->request = new Request([]);
        $this->response = new Response;
    }

    public function view($view, $params = [])
    {
        return $this->view->view($view, $params);
    }
}