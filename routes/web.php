<?php

$router->get('/', function () use ($container) {
    $controller = $container->get(App\Controllers\HomeController::class);
    $controller->index();
});

$router->get('/about', function () use ($container) {
    $controller = $container->get(App\Controllers\AboutController::class);
    $controller->index();
});

$router->get('/contact', function () use ($container) {
    $controller = $container->get(App\Controllers\ContactController::class);
    $controller->index();
});

$router->post('/contact', function () use ($container) {
    $controller = $container->get(App\Controllers\ContactController::class);
    $controller->create();
});

$router->set404(function () use ($container) {
    header('HTTP/1.1 404 Not Found');
    $container->get(App\Core\View::class)->view('partials.404');
});