<?php

namespace App\Controllers;

use App\Application;
use App\Core\Request;
use App\Model\BaseUser;
use App\Core\User;

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

    public static function loginHandler()
    {
        global $user;
        global $conn;
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if (empty($username) || empty($password)) {
                echo 'Warning: Please fill both fields';
            }
            $sql = "SELECT * FROM users WHERE username='$username'";
            $result = $conn->query($sql);
            if (!empty($result)) {
                if ($result->num_rows > 0) {
                    $user = \mysqli_fetch_array($result, \MYSQLI_ASSOC);
                    if (password_verify($password, $user['password'])) {
                        $id = session_regenerate_id(true);
                        $_SESSION['loggedin'] = true;
                        $_SESSION['name'] = $user['username'];
                        $_SESSION['id'] = $id;
                        $_SESSION['balance'] = 100;
                        $_SESSION['start'] = time();
                        $_SESSION['expire'] = $_SESSION['start'] + (30 * 120);
                        header('location: /profile');
                        exit;
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
