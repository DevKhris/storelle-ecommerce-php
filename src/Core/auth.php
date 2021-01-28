<?php

namespace App\Core;

use App\Core\User;
use App\Core\Database;
use App\Cart\ShoppingCart;

/**
 * Class Auth for user validation
 *
 * @package RubyNight\App\Core;
 * @author  Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */
class Auth
{
    private Database $db;
    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->db = new Database;
        return $this;
    }

    /**
     * Validate user authentication
     *
     * @param string $username user name
     * @param string $password user password
     *
     */
    public function validate($username, $password)
    {
        // validate if the vars are not empty
        if (empty($username) || empty($password)) {
            // if empty, triggers a warning
            echo 'Warning: Please fill both fields';
        }
        // Query to search if exists username in db with placeholder
        $result = $this->db->select('users', "username = '$username'");
        if (!empty($result)) {
            // verifies if passwords match
            if (password_verify($password, $result[0]['password'])) {
                // initialize new user session
                var_dump($result);
                $user = new User($result[0]['username'], $result[0]['balance']);
                // generate session id
                session_regenerate_id(true);
                // saves user id from array
                $id = $result[0]['id'];
                // set's the user to logged
                $_SESSION['auth'] = true;
                // assign name from username to session
                $_SESSION['username'] = $user->username;
                // assign id from user to session
                $_SESSION['id'] = $id;
                // assign balance from user to user session
                $_SESSION['balance'] = $user->balance;
                // set session start to current time
                $_SESSION['start'] = time();
                // set expiration time
                $_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
                // returns to home
                header('location: \dashboard');
            }
            // if wrong return to login
            header('location: \login');
        } else {
            header('location: \login');
        }
    }

    /**
     * Register function
     *
     * @param string $username user name
     * @param string $password user password
     *
     */
    public function register($username, $password)
    {
        // validate if the vars are not empty
        if (!empty($username) || !empty($password)) {
            // set initial balance to 100
            $balance = 100;
            // hashes the password
            $hash = password_hash($password, PASSWORD_ARGON2ID);
            //  query to register into table with safe values and hashing
            $data = "'$username', '$hash', '$balance'";
            $result = $this->db->insert('users', 'username, password , balance', $data);
            // checks if the query executed correctly
            if (!empty($result)) {
                // in that case display success
                echo '<p>Account successfully created, proceed to login.</p>';
                return header('location: \\');
            }
            // if not display warning
            echo '<p>Something go wrong, can\'t register account</p>';
        }
    }
}
