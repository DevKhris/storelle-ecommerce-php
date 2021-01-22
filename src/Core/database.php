<?php

namespace App\Core;

/**
 * Class Database for database management
 *
 * @package RubyNight\App\Core\Database;
 *
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */
class Database
{
    private $model;
    private $link, $dsn, $username, $password;

    /**
     * Constructor function
     */
    public function __construct()
    {
        // define connection credentials and connect
        $this->dsn = "mysql:host=localhost;dbname=storelle";
        $this->username = "root";
        $this->password = "";
        $this->connect();
    }

    public function connect()
    {
        // Try connection and return exception if the connection fails
        try {
            // save the connection to link
            $this->link = new \PDO($this->dsn, $this->username, $this->password);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function __wakeup()
    {
        $this->connect();
    }

    /**
     * Insert function
     *
     * @param string       $table
     * @param array        $columns
     * @param array|string $data
     *
     * @return void
     */
    public function insert($table, $columns, $data)
    {
        $sql = "INSERT INTO $table ($columns) VALUES ($data)";
        $result = $this->link->query($sql);
        if ($result) {
            return true;
        }
        return false;
    }

    /**
     * Select function
     *
     * @param string $table database table
     * @param array|string $data data to apss
     * @param array|string $args arguments
     *
     * @return void
     */
    public function select($table, $args = null)
    {
        $response = [];
        if ($args != null) {
            $sql = "SELECT * FROM $table WHERE $args";
            $result = $this->link->query($sql);
        } else {
            $sql = "SELECT * FROM $table";
            $result = $this->link->query($sql);
        }
        if (!empty($result)) {
            while ($rows = $result->fetchAll(\PDO::FETCH_ASSOC)) {
                $response = $rows;
            }
            return !empty($response) ? $response : false;
        }
        return false;
    }

    /**
     * Update function
     *
     * @param string $table
     * @param array|string $data
     * @param array|string $args
     *
     * @return void
     */
    public function update($table, $data, $args)
    {
        $sql = "UPDATE $table SET $data WHERE $args";
        $result = $this->link->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Delete query
     *
     * @param  string $table database table
     * @param  array|string $args  arguments
     *
     * @return boolean      result
     */
    public function delete($table, $args)
    {
        $sql = "DELETE FROM $table WHERE $args";
        $result = $this->link->query($sql);
        if ($result) {
            return true;
        }
        return false;
    }

    /**
     * Get average from given table and columns
     *
     * @param string $column      table column
     * @param string $totalColumn total from column
     * @param string $table       database table
     * @param string $totalTable  total from table
     * @param array|string $args  arguments
     *
     * @return array|boolean        average result
     */
    public function average($column, $totalColumn, $table, $totalTable, $args)
    {
        $sql = "SELECT AVG($column) AS $totalColumn, COUNT(*) AS $totalTable FROM $table WHERE $args";
        $result = $this->link->query($sql);
        // verify if result has value
        if ($result) {
            while ($rows = $result->fetchAll(\PDO::FETCH_ASSOC)) {
                $this->content = $rows;
            }
            return $this->content;
        }
        // returns array
        return false;
    }
}
