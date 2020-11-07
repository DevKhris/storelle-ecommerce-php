<?php
// require the psr-4 autoloader
require_once __DIR__ . '/vendor/autoload.php';

use App\Application;
use App\Config\DbConnection;
use App\Controllers\AuthController;
use App\Controllers\MainController;
use App\Core\Auth;

// connect to database
$conn = DbConnection::dbConnect();
// create new app instance
$app = new Application(__DIR__);

// starts the session if no one present
if (!isset($_SESSION)) {
    session_start();
}

// this routes stay the same even if it's logged or not
// Routes to home view
$app->router->get('/', [MainController::class, 'home']);
// Routes to about view
$app->router->get('/about', [MainController::class, 'about']);
// Routes to contact controller to render view
$app->router->get('/contact', [MainController::class, 'contact']);
// sets the controller for the current request
$app->router->set('/contact', [MainController::class, 'contactHandler']);

// check if visitor is logged and assigns the routes
if (Auth::checkLogin()) {

    //set an array for the routes to redirect to login
    $routes = array('products', 'product', 'shopping-cart', 'profile', 'login');

    //routes the rest to login due to user not logged into system
    foreach ($routes as $key => $value) {
        $route = $routes[$key];
        $app->router->get('/' . $route, [AuthController::class, 'login']);
    }

    $app->router->get('/login', [AuthController::class, 'login']);
    $app->router->get('/register', [AuthController::class, 'register']);
    // set controller handler for login and register
    $app->router->set('/login', [AuthController::class, 'loginHandler']);
    $app->router->set('/register', [AuthController::class, 'registerHandler']);
} else {
    // Routes products view to login view
    $app->router->get('/products', 'products');

    // Routes product  view to login view
    $app->router->get('/product', 'product');

    // Routes shopping cart view to login view
    $app->router->get('/shopping-cart', 'shopping-cart');

    // routes to profile because the user is logged
    $app->router->get('/login', 'profile');
    $app->router->get('/register', 'profile');
    $app->router->get('/profile', 'profile');
}

// execute the app
$app->execute();
