<?php

// Auth Middlewares
$router->before('GET|POST', '/login', '\App\Middlewares\IsUserSession@run');
$router->before('GET|POST', '/register', '\App\Middlewares\IsUserSession@run');

// Routes login to view
$router->get('/login', '\App\Controllers\Auth\LoginController@index');
$router->post('/login', '\App\Controllers\Auth\LoginController@login');

// Routes register to view
$router->get('/register', '\App\Controllers\Auth\RegisterController@index');
$router->post('/register', '\App\Controllers\Auth\RegisterController@register');

// Middlewares
$router->before('GET|POST', '/product/.*', '\App\Middlewares\IsUserAuth@run');

$router->before('GET|POST', '/shopping-cart', '\App\Middlewares\IsUserAuth@run');

$router->before('GET|POST', '/shopping-cart/*', '\App\Middlewares\IsUserAuth@run');

$router->before('GET|POST', '/dashboard', '\App\Middlewares\IsUserAuth@run');

$router->before('GET|POST', '/dashboard/.*', '\App\Middlewares\IsUserAuth@run');

// Routes products to view
$router->get('/products', '\App\Controllers\ProductsController@index');

// Sets controller for products callback
$router->post('/products', '\App\Controllers\ProductsController@show');

// Routes product to view
$router->get('/product/{id}', '\App\Controllers\ProductController@index');
$router->post('/product/{id}', '\App\Controllers\ProductController@show');

// Sets controller for review posting callback
$router->post('/reviews/{id}', '\App\Controllers\ReviewsController@store');

// Routes shopping cart to view
$router->get('/shopping-cart', '\App\Controllers\ShoppingCartController@index');
$router->post('/shopping-cart', '\App\Controllers\ShoppingCartController@show');
$router->post('/shopping-cart/add', '\App\Controllers\ShoppingCartController@store');
$router->post('/shopping-cart/remove', '\App\Controllers\ShoppingCartController@destroy');

$router->post('/checkout', '\App\Controllers\ShoppingCartController@checkout');

// Sets controller for dashboard callback functions
$router->get('/dashboard', '\App\Controllers\Dashboard\DashboardController@index');
$router->post('/dashboard', '\App\Controllers\Dashboard\DashboardController@show');
$router->post('/logout', '\App\Controllers\Dashboard\DashboardController@logout');