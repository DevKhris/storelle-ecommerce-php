<?php

namespace App\Config;

 // Define for connection constants
define('DB_USERNAME', 'root'); // Storelleroot
define('DB_PASSWORD',''); // Ell3r0tstoor@
define('DB_HOST','localhost');
define('DB_NAME','storelle');

class DbConnection
{
    function dbConnect()
    {
        // save the connection to var
        $conn = new \mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        // Test if the connection fails
        if ($conn->connect_errno)
        {
        // displays a message showing the error.
        //echo "Can't connect to database.";
        // closes
        exit;
        } else {
        // display a message when connection is successful
        echo "Connected to Database";
        }

        // Set physical path
        define('ROOT_PATH', realpath(dirname(__FILE__)));
        // Set base uri
        define('BASE_URL', 'http://localhost/storelle/');
    }
}

?>
