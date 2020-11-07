<?php

namespace App\Controllers;

use App\Application;
use App\Core\Request;

class AuthController
{

    public static function login()
    {
        return Application::$app->router->renderView('login');
    }

    public static function loginHandler()
    {
        global $conn;
        if (!empty($_POST['username']) || !empty($_POST['password'])) {
            $username = mysqli_escape_string($conn, $_POST['username']);
            $password = mysqli_escape_string($conn, $_POST['password']);
            if (empty($username) || empty($password)) {
                echo 'Warning: Please fill both fields';
            } else {
                $sql = "SELECT username FROM users WHERE username='$username' AND password='$password'";
                $result = \mysqli_query($conn, $sql);
                $row = \mysqli_num_rows($result);
                if (!empty($result) ||  $row > 0) {
                    $user = \mysqli_fetch_array($result);
                    if (\password_verify($password, $user['password'])) {
                        $id = session_regenerate_id(true);
                        $_SESSION['loggedIn'] = true;
                        $_SESSION['name'] =  $user['username'];
                        $_SESSION['id'] = $id;
                        $session = $_SESSION;
                        User::setUsername($session['name']);
                        switch (User::getBalance()) {
                            case 0:
                                User::setBalance(100);
                                break;
                            case 100:
                                break;
                            default:
                                break;
                        }
                    } else {
                        echo 'Incorrect username/password please try again!';
                        return false;
                    }
                } else {
                    echo 'Incorrect username/password please try again!';
                    return false;
                }
            }
        }
    }

    public static function register(Request $req)
    {
        if ($req->onPost()) {
            return 'Register succesfully';
        }
        return Application::$app->router->renderView('register');
    }

    public static function registerHandler()
    {
        global $conn;
        if (!empty($_POST['username']) || !empty($_POST['password'])) {
            $username = $_POST['password'];
            $password = $_POST['password'];
            $balance = 100;
            $safeUsername = mysqli_real_escape_string($conn, $username);
            $safePassword = mysqli_real_escape_string($conn, $password);
            $password = \password_hash($safePassword, \PASSWORD_ARGON2ID);
            if (empty($username) || empty($password)) {
                echo ('Warning: Please fill both fields');
            } elseif (empty($safeUsername) || empty($password)) {
                echo 'Warning: Please fill both fields';
            } else {
                $sql = "INSERT INTO users (username, passsword, balance) VALUES ('$safeUsername', '$password', '$balance')";
                var_dump($sql) . \PHP_EOL;
                if (\mysqli_query($conn, $sql)) {
                    echo '<p>Account successfully created, proceed to login.</p>';
                    header('location: /');
                } else {

                    echo '<p>Something go wrong, can\'t register account</p>';
                }
            }
        }
    }
}
