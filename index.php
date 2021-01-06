<?php


use App\Application;
use App\Core\Database;
/* start a new session */

session_start();

if (!isset($_SESSION['auth'])) {
    $_SESSION['auth'] = false;
}
// require the psr-4 autoloader
require_once __DIR__ . '/vendor/autoload.php';

// create new app instance
$app = new Application(__DIR__);

require_once __DIR__ . '/src/Core/routes.php';

// Set physical path
define('ROOT_PATH', realpath(dirname(__FILE__)));

// Set base uri
define('BASE_URL', 'http://storelle.me/');

// instance of database object
$db = new Database;