<?php
// require the psr-4 autoloader
require_once __DIR__ . '/vendor/autoload.php';

use App\Application;
use App\Config\DbConnection;
use App\Core\Auth;

// connect to database
$conn = DbConnection::dbConnect();
// create new app instance
$app = new Application(__DIR__);

// starts tje session
session_start();

// set's login to false in session
$_SESSION['loggedIn'] = false;

// check if visitor is logged and assigns the routes
if (!Auth::checkLogin()) {

    // Routes to home view
    $app->router->get('/', 'home');
    // Routes to about view
    $app->router->get('/about', 'about');
    // Routes to contact view
    $app->router->get('/contact', 'contact');

    //routes the rest to login due to user not logged in
    $app->router->get('/products', 'login');
    $app->router->get('/product', 'login');
    $app->router->get('/shopping-cart', 'login');
    $app->router->get('/profile', 'login');
    $app->router->get('/login', 'login');
    $app->router->get('/register', 'register');
} else {

    // Routes home view to login view
    $app->router->get('/', 'login');

    // Routes products view to login view
    $app->router->get('/products', 'login');

    // Routes product  view to login view
    $app->router->get('/product', 'login');

    // Routes shopping cart view to login view
    $app->router->get('/shopping-cart', 'login');

    // Routes about view to login view
    $app->router->get('/about', 'about');

    // Routes contact view to login view
    $app->router->get('/contact', 'contact');

    // routes to profile because the user is logged
    $app->router->get('/login', 'profile');
    $app->router->get('/register', 'profile');
    $app->router->get('/profile', 'profile');
}

// execute the app
$app->execute();
