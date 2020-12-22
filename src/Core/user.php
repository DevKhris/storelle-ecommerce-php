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
    public $balance;

    public function __construct($username, $balance)
    {
        $this->username = $username;
        $this->balance = $balance;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setBalance($balance)
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

    public function getBalance($username = null)
    {
        if (!empty($username)) {
            global $conn;
            $sql = "SELECT balance FROM users WHERE username=?";
            $stmt = $conn->prepare($sql);

            $result = $stmt->execute([$username]);

            if ($result) {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning, Can\'t get user balance!</strong>
                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                  </div>';
            }
            $result = $stmt->fetchAll();
            var_dump($result);
            $user = array('balance' => $result[0]);

            $jsonUser = json_encode($user);
            return $jsonUser;
        } else {
            return $this->balance;
        }
    }
}