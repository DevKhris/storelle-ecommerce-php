<?php

namespace App\Core;

use App\Cart\ShoppingCart;
use App\Core\User;
use App\Model\BaseUser;

/**
 * Class Auth for user validation
 *
 * @package RubyNight\App\Core;
 *
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */
class Auth
{
    /**
     * [Validate user authentication]
     * @param  [string] $username [user username]
     * @param  [string] $password [user password]
     *
     * @return [type]           [description]
     */
    public static function validate($username, $password)
    {
        global $user;
        global $conn;
        // validate if the vars are not empty
        if (empty($username) || empty($password)) {
            // if empty, triggers a warning
            echo 'Warning: Please fill both fields';
        } else {
            // Query to search if exists username in db with placeholder
            $sql = "SELECT * FROM users WHERE username=?";
            // prepare statement
            $stmt = $conn->prepare($sql);
            // execute the query and store result
            $result = $stmt->execute([$username]);
            // checks if the result is not empty
            if (!empty($result)) {
                // if not fetch the result as an associative array
                if ($result) {
                    // save array to var
                    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
                    // verifys if passwords match
                    if (password_verify($password, $result['password'])) {
                        // initialize new user sesssion
                        $user = new User($result['username'], $result['balance']);
                        // generate sesssion id
                        $id = session_regenerate_id(true);
                        // saves user id from array
                        $uId = $result['id'];
                        // get's shopping cart from user id
                        $cart = ShoppingCart::getCart($uId);
                        // set's the user to logged
                        $_SESSION['loggedin'] = true;
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
                        // set shopping cart to session
                        //$_SESSION['cart'] = array($cart);
                        // returns to home
                        header('location: \\');
                        // exits with 500 code
                        exit(500);
                    } else {
                        // if wrong return to login
                        header('location: \login');
                    }
                }
            }
        }
    }

    public static function register($username, $password)
    {
        global $conn;

        // validate if the vars are not empty
        if (!empty($username) || !empty($password)) {
            // set initial balance to 100
            $balance = 100;
            // escape string for illegal characters
            $safeUsername = mysqli_real_escape_string($conn, $username);
            $safePassword = mysqli_real_escape_string($conn, $password);
            // hashes the password
            $password = \password_hash($safePassword, \PASSWORD_ARGON2ID);
            // validates if unsafe and safe are empty
            if (empty($username) || empty($password)) {
                // displays warning
                echo ('Warning: Please fill both fields');
            } elseif (empty($safeUsername) || empty($password)) {
                echo 'Warning: Please fill both fields';
            } else {
                // if valid insert register into table with safe values and hashing
                $sql = "INSERT INTO users (username, passsword, balance) VALUES ('$safeUsername', '$password', '$balance')";
                // checks if the query executed correctly
                if (mysqli_query($conn, $sql)) {
                    // in that case display successs
                    echo '<p>Account successfully created, proceed to login.</p>';
                    header('location: \\');
                } else {
                    // if not display warning
                    echo '<p>Something go wrong, can\'t register account</p>';
                }
            }
        }
    }
}