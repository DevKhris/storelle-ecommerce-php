$router = new Router();<?php

/*-------------------------------
 *	Front Controller
 *-------------------------------
 **/
require __DIR__ . '/../vendor/autoload.php';
$container = require __DIR__ . '/../src/bootstrap.php';

use Whoops\Run;

use App\Application;
use Bramus\Router\Router;
use Whoops\Handler\PrettyPageHandler;

session_start();

$whoops = new Run;
$whoops->writeToOutput(true);
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();

$router = new Router();

if (!isset($_SESSION['auth'])) {
    $_SESSION['auth'] = false;
}

// require routes
require_once __DIR__ . '/../routes/web.php';
// require_once __DIR__ . '/../routes/auth.php';

$router->run();