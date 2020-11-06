<?php

namespace App\Core;

use App\Model\BaseUser;
use App\Core\User;
use APp\Core\Router;

class Auth
{
    public BaseUser $user;
    public $session;
    /**
     *  Checks if the user is currently logged and returns result
     * @return bool
     **/
    public static function checkLogin()
    {
        $session = $_SESSION['loggedIn'];
        if (!$session = true) {
            return true;
        } else {
            return false;
        }
    }

    public function loginUser()
    {
        global $conn;
        $username = $_POST['user'];
        $password = $_POST['password'];
        if (!isset($username, $password)) {
            exit('Warning: Please fill both fields');
        } else {
            $sql = ("SELECT id password FROM users WHERE username = $username");

            $result = \mysqli_query($conn, $sql);

            if (!empty($result) || \mysqli_num_rows($result) > 0) {
                if (\password_verify($password, $_POST['password'])) {
                    $id = session_regenerate_id(true);
                    $_SESSION['loggedin'] = TRUE;
                    $_SESSION['name'] = $_POST['user'];
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
                    echo 'Welcome back, ' . $session['name'] . '|';
                    return $session;
                    header('Location: login');
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
    public function registerUser($username, $password)
    {
        global $conn;
        $balance = 100;
        $password = \password_hash($password, \PASSWORD_ARGON2ID);
        if (!isset($username, $password)) {
            exit('Warning: Please fill both fields');
        } elseif (empty($username) || empty($password)) {
            exit('Warning: Please fill both fields');
        } else {
            $sql = "INSERT INTO users (username, password, balance) VALUES ($username, $password, $balance)";
            $result = mysqli_query($sql);
            if ($result) {
                echo 'Account successfully created, proceed to login';
            } else {
                echo 'Something go wrong, can\'t register account';
            }
        }
    }

    public function logoutUser()
    {
        if (\session_destroy()) {
            header('Location: \login');
        } else {
            \session_unset();
            \session_abort();
            header('Location: \login');
        }
    }
}
