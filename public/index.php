<?php

/*-------------------------------
 *	Front Controller
 *-------------------------------
 **/

use App\Application;
use DebugBar\StandardDebugBar;

// start new session
session_start();

// require the psr-4 autoloader
require_once '../vendor/autoload.php';
// require config
require_once '../src/Core/config.php';

//if no session exist set auth to false
if (!isset($_SESSION['auth'])) {
    $_SESSION['auth'] = false;
}

// create new app instance
$app = new Application(BASE_PATH);

// require routes
require_once BASE_PATH . '/routes/web.php';
require_once BASE_PATH . '/routes/auth.php';

$app->execute();