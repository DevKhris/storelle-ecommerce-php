<?php

/*-------------------------------
 *	Front Controller
 *-------------------------------
 **/
require __DIR__ . '/../vendor/autoload.php';

use Whoops\Run;

use Whoops\Handler\PrettyPageHandler;
use App\Application;

session_start();

$whoops = new Run;
$whoops->writeToOutput(true);
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();

// require config
$config = require __DIR__ . '/../src/Core/config.php';

//if no session exist set auth to false
if (!isset($_SESSION['auth'])) {
    $_SESSION['auth'] = false;
}

$app = new Application($config['path']);

// require routes
require_once __DIR__ . '/../routes/web.php';
require_once __DIR__ . '/../routes/auth.php';

$app->execute();