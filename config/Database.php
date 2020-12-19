<?php
/**
 * Class Database for database connection management
 *
 * @package RubyNight\App\Config;
 *
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */

namespace App\Config;

class Database
{
    /**
     * [Constructor function]
     */
    function __construct()
    {
        $_dsn = "mysql:host=localhost;dbname=storelle;";
         $_dbUser = "root";
         $_dbPassword = "";
        // Try connection and return exception if the connection fails
        try {
            // save the connection to self instance
            $this->conn = new \PDO($_dsn, $_dbUser, $_dbPassword);
        } catch (PDOException $e) {
            // throw exception
            throw $e->getMessage();
            die();
        }
    }

    /**
     * [Return instance of database connection]
     *
     * @return [PDO] [instance of connection]
     */
    public function get()
    {
        if ($this->conn instanceof PDO) {
            echo "Is connected";
            return $this->conn;
        }
    }
}
