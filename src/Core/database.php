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
    private $link, $_dsn, $_username, $_password;

    /**
     * Constructor function
     */
    public function __construct()
    {
        // define connection credentials and connect
        $this->_dsn = "mysql:host=localhost;dbname=storelle";
        $this->_username = "root";
        $this->_password = "";
        $this->connect();
    }

    /**
     * Connect to DB with PDO 
     *
     * @return void
     */
    public function connect()
    {
        // Try connection and return exception if the connection fails
        try {
            // save the connection to link
            $this->link = new \PDO($this->_dsn, $this->_username, $this->_password);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Connect in wakeup
     */
    public function __wakeup()
    {
        $this->connect();
    }

    /**
     * Insert function
     *
     * @param string       $table   table to insert
     * @param array        $columns columns to insert
     * @param array|string $data    data to insert in row
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
     * @param string       $table database table
     * @param array|string $args  arguments to search
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
     * Select function
     * 
     * @param array|string $row   row to search from
     * @param string       $table database table
     * @param array|string $args  arguments to search
     *
     * @return void
     */
    public function selectFrom($row, $table, $args)
    {
        if ($args != '' && $row != '') {
            $sql = "SELECT $row FROM $table WHERE $args";
            $result = $this->link->query($sql);
            return !empty($result) ? $result : false;
        }
    }
    /**
     * Update function
     *
     * @param string       $table table to update
     * @param array|string $data  data used to update
     * @param array|string $args  arguments
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
     * @param string       $table database table
     * @param array|string $args  arguments
     *
     * @return boolean     result
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
     * @param string       $column      table column
     * @param string       $totalColumn total from column
     * @param string       $table       database table
     * @param string       $totalTable  total from table
     * @param array|string $args        arguments
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
