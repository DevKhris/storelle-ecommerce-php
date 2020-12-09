<?php

namespace App\Controllers;

use App\Application;
use App\Core\Request;

class ContactController
{
    /**
     * [contact router render]
     *
     * @return [view] [render view]
     */
    public static function index()
    {
        // render view from router for contact
        return Application::$app->router->renderView('contact');
    }

    /**
     * [contactHandler for contact requests]
     * @param Request $req [request]
     *
     * @return [array]       [body]
     */
    public function send(Request $req)
    {
        // get body from requests
        $body = $req->getBody();
        // return body
        return $body;
    }
}
