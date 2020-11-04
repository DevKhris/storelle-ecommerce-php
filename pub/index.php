<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Application;
use App\Config\DbConnection;

// connect to database
$conn = DbConnection::dbConnect();
// create new app instance
$app = new Application(dirname(__DIR__));

session_start();

$app->router->get('/', 'home');

$app->router->get('/products', 'products');

$app->execute();

?>