<?php

/**
 * Class User for building user extended from BaseUser model
 * 
 * @package RubyNight\App\Core;
 * 
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */

namespace App\Core;

use App\Model\BaseUser;

class User extends BaseUser
{
    public $username;
    public $password;
    public $balance;

    public function setUsername($username)
    {
        $this->user['username'] = $username;
    }
    public  function getUsername($username)
    {
        return $this->user['username'];
    }

    public function setPassword($password)
    {
        $this->user['password'] = $username;
    }
    public function getPassword($password)
    {
        return $this->user['password'];
    }

    public function setBalance($balance)
    {
        $this->user['balance'] = $balance;
    }

    public static function getBalance($username)
    {
        global $conn;
        $sql = "SELECT balance FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            echo ('Can\'t get user balance');
        }

        $user = array();
        while ($row = mysqli_fetch_array($result)) {
            $user[] = array(
                'balance' => $row['balance']
            );
        }

        $jsonUser = json_encode($user);
        return $jsonUser;
    }
}
