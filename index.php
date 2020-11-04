<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Application;
use App\Config\DbConnection;

// connect to database
$conn = DbConnection::dbConnect();
// create new app instance
$app = new Application(__DIR__);

session_start();

$app->router->get('/', 'home');

$app->router->get('/products', 'products');

$app->router->get('/product', 'product');

$app->router->get('/profile', 'profile');

$app->router->get('/login', 'login');

$app->router->get('/register', 'register');

$app->execute();

?>