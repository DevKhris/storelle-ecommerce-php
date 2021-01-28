<?php

use App\Application;
use App\Core\Database;

// start new session
session_start();

//if no session exist set auth to false
if (!isset($_SESSION['auth'])) {
    $_SESSION['auth'] = false;
}

// require config
require_once __DIR__ . '/src/Core/config.php';

// require the psr-4 autoloader
require_once BASE_PATH . '/vendor/autoload.php';

// create new app instance
$app = new Application(BASE_PATH);

// require routes
require_once BASE_PATH . '/src/Core/routes.php';

// instance of database object
$db = new Database;
