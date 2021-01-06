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
    public function __construct()
    {
        return $this;
    }
    /**
     * Validate user authentication
     * 
     * @param string $username user name
     * @param string $password user password
     */
    public function validate($username, $password)
    {
        $db = new Database;
        // validate if the vars are not empty
        if (empty($username) || empty($password)) {
            // if empty, triggers a warning
            echo 'Warning: Please fill both fields';
        }
        // Query to search if exists username in db with placeholder
        $result = $db->select('users', "username = '$username'");
        if ($result) {
            // verifys if passwords match
            if (password_verify($password, $result['password'])) {
                // initialize new user sesssion
                $user = new User($result['username'], $result['balance']);
                // generate sesssion id
                $id = session_regenerate_id(true);
                // saves user id from array
                $uId = $result['id'];
                // set's the user to logged
                $_SESSION['auth'] = true;
                // assign name from username to session
                $_SESSION['username'] = $user->getUsername();
                // assign id from id to session
                $_SESSION['id'] = $id;
                // assign id from user to session
                $_SESSION['uid'] = $uId;
                // assign balance from user to user session
                $_SESSION['balance'] = $user->getBalance();
                // set session start to current time
                $_SESSION['start'] = time();
                // set expiration time
                $_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
                // returns to home
                header('location: \\');
            }
            // if wrong return to login
            header('location: \login');
        }
    }

    /**
     * Register function
     *
     * @param string $username user name
     * @param string $password user password
     */
    public function register($username, $password)
    {
        $db = new Database;
        // validate if the vars are not empty
        if (!empty($username) || !empty($password)) {
            // set initial balance to 100
            $balance = 100;
            // hashes the password
            $hash = \password_hash($password, \PASSWORD_ARGON2ID);
            //  query to register into table with safe values and hashing
            $data = "'$username', '$hash', '$balance'";
            $result = $db->insert('users', 'username, password , balance', $data);
            // checks if the query executed correctly
            if (!empty($result)) {
                // in that case display successs
                echo '<p>Account successfully created, proceed to login.</p>';
                return header('location: \\');
            }
            // if not display warning
            echo '<p>Something go wrong, can\'t register account</p>';
        }
    }
}