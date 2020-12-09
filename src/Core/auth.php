<?php

namespace App\Core;

use App\Cart\ShoppingCart;
use App\Core\User;
use App\Model\BaseUser;

/**
 *
 */
class Auth
{
    
    public static function validate()
    {
        global $user;
        global $conn;
        // if username and password is set via post
        if (isset($_POST['username']) && isset($_POST['password'])) {
            // passes both values to correspondent vars
            $username = $_POST['username'];
            $password = $_POST['password'];

            // validate if the vars are not empty
            if (empty($username) || empty($password)) {
                // if empty, triggers a warning
                echo 'Warning: Please fill both fields';
            } else {
                // Query to search username and if exists
                $sql = "SELECT * FROM users WHERE username='$username'";
                // stores the result
                $result = mysqli_query($conn, $sql);
                // checks if the result it not empty
                if (!empty($result)) {
                    // if not fetch the result as an associative array
                    if ($result->num_rows > 0) {
                        // save array to var
                        $user = \mysqli_fetch_array($result, \MYSQLI_ASSOC);
                        // verifys if passwords match
                        if (password_verify($password, $user['password'])) {
                            // generate sesssion id
                            $id = session_regenerate_id(true);
                            // saves user id from array
                            $uId = $user['id'];
                            // get's shopping cart from user id
                            $cart = ShoppingCart::getCart($uId);
                            // set's the user to logged
                            $_SESSION['loggedin'] = true;
                            // assign name from username to session
                            $_SESSION['name'] = $user['username'];
                            // assign id from id to session
                            $_SESSION['id'] = $id;
                            // assign id from user to session
                            $_SESSION['uid'] = $uId;
                            // assign balance from user to session
                            $_SESSION['balance'] = $user['balance'];
                            // set session start to current time
                            $_SESSION['start'] = time();
                            // set expiration time
                            $_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
                            // set shopping cart to session
                            $_SESSION['cart'] = array($cart);
                            // returns to home
                            header('location: \\');
                            // exits with 500 code
                            exit(500);
                        }
                    } else {
                        // if wrong return to login
                        echo 'Wrong username or password';
                        header('location: \login');
                    }
                }
            }
        }
    }

    public static function register()
    {
        global $conn;

        // validate if the vars are not empty
        if (!empty($_POST['username']) || !empty($_POST['password'])) {
            // passes both values to correspondent vars
            $username = $_POST['password'];
            $password = $_POST['password'];
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
