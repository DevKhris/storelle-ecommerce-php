<?php

namespace App\Controllers;

use App\Application;
use App\Core\Request;
use App\Model\BaseUser;
use App\Core\User;
use mysqli;

class AuthController
{
    public $username;
    public $password;
    public static function login(Request $req)
    {
        if ($req->onPost()) {
            return 'Logged in succesfully';
        }
        return Application::$app->router->renderView('login');
    }

    public function logoutHandler()
    {
        $_SESSION['loggedin'] = false;
        if (\session_destroy()) {
            header('Location: \login');
            die;
        }
        \session_unset();
        \session_abort();
        header('Location: \login');
        die;
    }
    public static function loginHandler()
    {
        global $user;
        global $conn;
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if (empty($username) || empty($password)) {
                echo 'Warning: Please fill both fields';
            } else {
                $sql = "SELECT * FROM users WHERE username='$username'";
                $result = mysqli_query($conn, $sql);
                if (!empty($result)) {
                    if ($result->num_rows > 0) {
                        $user = \mysqli_fetch_array($result, \MYSQLI_ASSOC);
                        if (password_verify($password, $user['password'])) {
                            $id = session_regenerate_id(true);
                            $_SESSION['loggedin'] = true;
                            $_SESSION['name'] = $user['username'];
                            $_SESSION['id'] = $id;
                            $_SESSION['balance'] = $user['balance'];
                            $_SESSION['start'] = time();
                            $_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
                            header('location: \\');
                            exit(500);
                        }
                    } else {
                        echo 'Wrong username or password';
                        header('location: \login');
                    }
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
                if (\mysqli_query($conn, $sql)) {
                    echo '<p>Account successfully created, proceed to login.</p>';
                    header('location: \\');
                } else {
                    echo '<p>Something go wrong, can\'t register account</p>';
                }
            }
        }
    }
}
