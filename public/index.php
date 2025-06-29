<?php

/*-------------------------------
 *	Front Controller
 *-------------------------------
 **/
require __DIR__ . '/../vendor/autoload.php';

use Whoops\Run;
use Bramus\Router\Router;
use Whoops\Handler\PrettyPageHandler;

$whoops = new Run;
$whoops->writeToOutput(true);
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();

$container = require __DIR__ . '/../src/bootstrap.php';
$router = new Router();

if (!isset($_SESSION['auth'])) {
    $_SESSION['auth'] = false;
}

// require routes
require_once __DIR__ . '/../routes/api.php';
require_once __DIR__ . '/../routes/web.php';
require_once __DIR__ . '/../routes/auth.php';

$router->run();