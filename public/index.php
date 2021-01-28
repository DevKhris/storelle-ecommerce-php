<?php

/*-------------------------------
 *	Front Controller
 *-------------------------------
 **/

use App\Application;
use App\Core\Database;

// start new session
session_start();

//if no session exist set auth to false
if (!isset($_SESSION['auth'])) {
    $_SESSION['auth'] = false;
}

// require the psr-4 autoloader
require_once '../vendor/autoload.php';
// require config
require_once '../src/Core/config.php';

// create new app instance
$app = new Application(BASE_PATH);

// require routes
require_once BASE_PATH . '/src/Core/routes.php';
