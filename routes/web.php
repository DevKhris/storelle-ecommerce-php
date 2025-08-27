<?php

 $router->set404(function () use ($container) {
    header('HTTP/1.1 404 Not Found');
    $container->get(Mythos\Engine\View::class)->view('partials.404');
});

/**
 * Main routes
 */
$router->get('/', function () use ($container) {
    $controller = $container->get(App\Controllers\HomeController::class);
    $controller->index($container->get('App\Services\ProductService'));
});

$router->get('/products', function () use ($container) {
    $controller = $container->get(App\Controllers\ProductController::class);
    $controller->index($container->get('App\Services\ProductService'));
});

$router->get('/product/{id}', function (int $id) use ($container) {
    $controller = $container->get(App\Controllers\ProductController::class);
    $controller->show($container->get('App\Services\ProductService'), $id);
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

/**
 * User routes.
 */
$router->before('GET|POST', '/dashboard/', function() use ($container) {
    $middleware = $container->get(\App\Middlewares\IsAuthenticated::class);
    $middleware->handle();
});

$router->get('/dashboard', function() use ($container) {
    $controller = $container->get(App\Controllers\Dashboard\DashboardController::class);
    $controller->index();
});

$router->post('/reviews', function() use ($container) {
    $controller = $container->get(App\Controllers\ReviewsController::class);
    $controller->store($container->get('App\Services\ReviewService'), $container->get('Psr\Http\Message\RequestInterface'));
});
// $router->post('/dashboard', '\App\Controllers\Dashboard\DashboardController@show');

