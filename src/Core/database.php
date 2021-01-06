<?php

/**
 * Class Database for database connection management
 *
 * @package RubyNight\App\Core\Database;
 *
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */

namespace App\Core;

class Database
{
    private $model;
    private $db;

    /**
     * [Constructor function]
     */
    public function __construct()
    {
        // Try connection and return exception if the connection fails
        try {
            $dsn = "mysql:host=localhost;dbname=storelle";
            $dbUser = "root";
            $dbPassword = "";
            // save the connection to self instance
            $this->db = new \PDO($dsn, $dbUser, $dbPassword);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Insert function
     *
     * @param string $table
     * @param  array $data
     * 
     * @return void
     */
    public function insert($table, $columns, $data)
    {
        $sql = "INSERT INTO $table ($columns) VALUES ($data)";
        $result = $this->db->query($sql);
        if ($result) {
            return true;
        }
        return false;
    }

    /**
     * Undocumented function
     *
     * @param string $table
     * @param array $data
     * @param string $args
     * 
     * @return void
     */
    public function select($table, $args = null)
    {
        if ($args != null) {
            $sql = "SELECT * FROM $table WHERE $args";
            $result = $this->db->query($sql);
        } else {
            $sql = "SELECT * FROM $table";
            $result = $this->db->query($sql);
        }
        if ($result) {
            while ($rows = $result->fetchAll(\PDO::FETCH_ASSOC)) {
                $this->content = $rows;
            }
            return $this->content;
        }
        return false;
    }

    /**
     * Update function
     *
     * @param string $table
     * @param array $data
     * @param string $args
     * 
     * @return void
     */
    public function update($table, $data, $args)
    {
        $sql = "UPDATE $table SET $data WHERE $args";
        $result = $this->db->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($table, $args)
    {
        $sql = "DELETE FROM $table WHERE $args";
        $result = $this->db->query($sql);
        if ($result) {
            return true;
        }
        return false;
    }

    public function average($column, $totalColumn, $table, $totalTable, $args)
    {
        $sql = "SELECT AVG($column) AS $totalColumn, COUNT(*) AS $totalTable FROM $table WHERE $args";
        $result = $this->db->query($sql);
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