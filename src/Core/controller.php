<?php

namespace App\Core;

use App\Core\View;

abstract class Controller
{
    public View $view;

    public Request $request;

    public Response $response;

    public function __construct()
    {
        $this->view = new View;
        $this->request = new Request([]);
        $this->response = new Response;
    }

    public function view($view, $params = [])
    {
        return $this->view->view($view, $params);
    }
}