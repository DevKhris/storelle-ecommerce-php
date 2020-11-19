<?php
/**
 * Class DbConnection for db connection managing
 * 
 * @package RubyNight\App\Config;
 * 
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */

namespace App\Config;

// Define for connection constants
define('DB_USERNAME', 'root'); // Storelleroot
define('DB_PASSWORD', ''); // Ell3r0tstoor@
define('DB_HOST', 'localhost');
define('DB_NAME', 'storelle');

global $conn;

class DbConnection
{
    /**
     * [dbConnect connection to db function]
     * @return [value] [connection]
     */
    public static function dbConnect()
    {
        // save the connection to var
        $conn = new \mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        // Test if the connection fails
        if ($conn->connect_errno) {
            exit;
        }
        // Set physical path
        define('ROOT_PATH', realpath(dirname(__FILE__)));
        // Set base uri
        define('BASE_URL', 'http://localhost/storelle/');
        // returns connection
        return $conn;
    }
}
