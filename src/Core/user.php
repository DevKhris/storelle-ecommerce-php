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
    protected $username;
    protected $password;
    protected $balance;
    
    public function getUsername()
    {
        return $this->name['username'];
    }

    public function setUsername($username)
    {
        $this->user['username'] = $username;
    }

    public function setPassword($password)
    {
        $this->user['password'] = $password;
    }
    public function getPassword()
    {
        return $this->user['password'];
    }

    public static function setBalance($balance, $uid)
    {
        global $conn;
        $sql = "UPDATE users SET balance='$balance' WHERE id='$uid'";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning, Can\'t update funds!</strong>
                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Successfully updated funds!</strong>
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
              </div>';
    }

    public static function getBalance()
    {
        global $conn;
        $sql = "SELECT balance FROM users WHERE username='$this->user['username']'";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning, Can\'t get user balance!</strong>
                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                  </div>';
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
