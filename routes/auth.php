<?php

use App\Middlewares\IsUserAuth;

$protectedRoutes = [
    'products/.*',
    'product/.*',
    'shopping-cart/.*',
    'dashboard/.*'
];

foreach ($protectedRoutes as $route) {
    $app->router->before('GET|POST', $route, 'App\Middlewares\IsUserAuth@run');
}

// Routes login to view
$app->router->get('/login', '\App\Controllers\Auth\LoginController@index');
$app->router->post('/login', '\App\Controllers\Auth\LoginController@login');

// Routes register to view
$app->router->get('/register', '\App\Controllers\Auth\RegisterController@index');
$app->router->post('/register', '\App\Controllers\Auth\RegisterController@register');

// Routes products to view
$app->router->get('/products', '\App\Controllers\ProductsController@index');

// Sets controller for products callback
$app->router->post('/products', '\App\Controllers\ProductsController@show');

// Routes product to view
$app->router->get('/product/{id}', '\App\Controllers\ProductController@index');
$app->router->post('/product/{id}', '\App\Controllers\ProductController@show');

// Sets controller for review posting callback
$app->router->post('/reviews/{id}', '\App\Controllers\ReviewsController@store');

// Routes shopping cart to view
$app->router->get('/shopping-cart', '\App\Controllers\ShoppingCartController@index');
$app->router->post('/shopping-cart', '\App\Controllers\ShoppingCartController@show');
$app->router->post('/shopping-cart/add', '\App\Controllers\ShoppingCartController@store');
$app->router->post('/shopping-cart/remove', '\App\Controllers\ShoppingCartController@destroy');

$app->router->post('/checkout', '\App\Controllers\ShoppingCartController@checkout');

// Sets controller for dashboard callback functions
$app->router->get('/dashboard', '\App\Controllers\Dashboard\DashboardController@index');
$app->router->post('/dashboard', '\App\Controllers\Dashboard\DashboardController@show');
$app->router->post('/logout', '\App\Controllers\Dashboard\DashboardController@logout');