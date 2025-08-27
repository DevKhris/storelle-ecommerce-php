<?php

// Auth Middlewares
// $router->before('GET|POST', '/login', '\App\Middlewares\HasSession@run');
// $router->before('GET|POST', '/register', '\App\Middlewares\HasSession@run');

/**
 * Auth Routes
 */
$router->get('/login', function () use ($container) {
    $controller = $container->get(App\Controllers\Auth\LoginController::class);
    $controller->index();
});
$router->post('/login', function () use ($container) {
    $controller = $container->get(App\Controllers\Auth\LoginController::class);
    $controller->login($container->get(App\Services\AuthService::class), $container->get('Psr\Http\Message\RequestInterface'));
});
$router->get('/register', function () use ($container) {
    $controller = $container->get(App\Controllers\Auth\RegisterController::class);
    $controller->index();
});
$router->post('/register', function () use ($container) {
    $controller = $container->get(App\Controllers\Auth\RegisterController::class);
    $controller->register($container->get('App\Services\AuthService'), $container->get('Psr\Http\Message\RequestInterface'));
});

$router->post('/logout', function() use ($container) {
    $controller = $container->get(App\Controllers\Auth\LoginController::class);
    $controller->logout($container->get('App\Services\AuthService'));
});

// // Middlewares
// $router->before('GET|POST', '/product/.*', '\App\Middlewares\IsUserAuth@run');

// $router->before('GET|POST', '/shopping-cart', '\App\Middlewares\IsUserAuth@run');

// $router->before('GET|POST', '/shopping-cart/*', '\App\Middlewares\IsUserAuth@run');

// $router->before('GET|POST', '/dashboard', '\App\Middlewares\IsUserAuth@run');

// $router->before('GET|POST', '/dashboard/.*', '\App\Middlewares\IsUserAuth@run');

// // Routes product to view

// $router->post('/product/{id}', '\App\Controllers\ProductController@show');

// // Sets controller for review posting callback
// $router->post('/reviews/{id}', '\App\Controllers\ReviewsController@store');

// // Routes shopping cart to view
// $router->get('/shopping-cart', '\App\Controllers\ShoppingCartController@index');
// $router->post('/shopping-cart', '\App\Controllers\ShoppingCartController@show');
// $router->post('/shopping-cart/add', '\App\Controllers\ShoppingCartController@store');
// $router->post('/shopping-cart/remove', '\App\Controllers\ShoppingCartController@destroy');

// $router->post('/checkout', '\App\Controllers\ShoppingCartController@checkout');

// // Sets controller for dashboard callback functions
// $router->get('/dashboard', '\App\Controllers\Dashboard\DashboardController@index');
// $router->post('/dashboard', '\App\Controllers\Dashboard\DashboardController@show');
