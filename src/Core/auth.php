<?php

namespace App\Core;

use App\Model\BaseUser;
use App\Core\User;
use App\Config\DbConnection;

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
        if (!$session) {
            return true;
        } else {
            return false;
        }
    }

    public function logIn()
    {
        global $conn;
        $username = $_POST['user'];
        $password = $_POST['password'];
        if (!isset($username, $password)) {
            exit('Warning: Please fill both fields');
        } else {
            $sql = ('SELECT id password FROM users WHERE username = $user?');

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
