<?php

namespace App\Controllers;

use Mythos\Engine\View;
use Nyholm\Psr7\Request;
use Nyholm\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class Controller
{
    public $request;
    public $response;

    public View $view;

    public function __construct(RequestInterface $request, ResponseInterface $response, View $view)
    {
        $this->view = $view;
        $this->request = $request;
        $this->response = $response;
    }

    public function view($view, $params = [])
    {
        return $this->view->view($view, $params);
    }
}