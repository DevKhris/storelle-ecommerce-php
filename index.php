<?php
/* start a new session */
session_start();
// require the psr-4 autoloader
require_once __DIR__ . '/vendor/autoload.php';

use App\Application;
use App\Config\DbConnection;
use App\Controllers\AboutController;
use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\RegisterController;
use App\Controllers\ContactController;
use App\Controllers\Dashboard\DashboardController;
use App\Controllers\HomeController;
use App\Controllers\MainController;
use App\Controllers\ProductController;
use App\Controllers\ProductsController;
use App\Controllers\ReviewsController;
use App\Controllers\ShoppingCartController;
use App\Core\Auth;

// connect to database
$conn = DbConnection::dbConnect();
// create new app instance
$app = new Application(__DIR__);

// this routes stay the same even if it's logged or not
// Routes to home view
$app->router->get('/', [HomeController::class, 'index']);
// Routes to about view
$app->router->get('/about', [AboutController::class, 'index']);
// Routes to contact controller to render view
$app->router->get('/contact', [ContactController::class, 'index']);
// sets the controller for the current request
$app->router->post('/contact', [ContactController::class, 'send']);

// check if visitor is logged and assigns the routes
if (!isset($_SESSION['loggedin'])) {
    //set an array for the routes to redirect to login
    $routes = array('products', 'product', 'shopping-cart', 'dashboard');

    //routes the rest to login
    foreach ($routes as $key => $value) {
        $route = $routes[$key];
        $app->router->get('/' . $route, [LoginController::class, 'index']);
        $app->router->post('/' . $route, [LoginController::class, 'login']);
    }

    // Routes login to view
    $app->router->get('/login', [LoginController::class, 'index']);
    $app->router->post('/login', [LoginController::class, 'login']);

    // Routes register to view
    $app->router->get('/register', [RegisterController::class, 'index']);
    $app->router->post('/register', [RegisterController::class, 'register']);
} else {
    // Routes products to view
    $app->router->get('/products', [ProductsController::class, 'index']);
    // Sets controller for products callback
    $app->router->post('/products', [ProductsController::class, 'get']);

    // Routes product to view
    $app->router->get('/product', [ProductController::class, 'index']);
    // Sets controller for product callback
    $app->router->post('/product', [ProductController::class, 'get']);

    // Sets controller for reviews view
    $app->router->get('/reviews', [ReviewsController::class, 'index']);

    // Sets controller for reviews callback
    $app->router->post('/review', [ReviewsController::class, 'get']);

    // Sets controller for review posting callback
    $app->router->post('/publish', [ReviewsController::class, 'add']);

    // Routes shopping cart to view
    $app->router->get('/shopping-cart', [ShoppingCartController::class, 'index']);

    $app->router->post('/shopping-cart', [ShoppingCartController::class, 'get']);

    // route auth routes to dashboard because the user is logged in
    $app->router->get('/login', [DashboardController::class, 'index']);
    $app->router->get('/register', [DashboardController::class, 'index']);
    
    // Sets controller for dashboard callback functions
    $app->router->get('/dashboard', [DashboardController::class, 'index']);
    $app->router->post('/dashboard', [DashboardController::class, 'get']);
    $app->router->get('/logout', [DashboardController::class, 'logout']);
}

// execute the app
$app->execute();
