<?php

// Routes to home view
$app->router->get('/', '\App\Controllers\HomeController@index');
// Routes to about view
$app->router->get('/about', '\App\Controllers\AboutController@index');
// Routes to contact controller to render view
$app->router->get('/contact', '\App\Controllers\ContactController@index');
// sets the controller for the current request
$app->router->post('/contact', '\App\Controllers\ContactController@create');

$app->router->set404(function () use ($app) {
    header('HTTP/1.1 404 Not Found');
    $app->view->view('partials.404');
});