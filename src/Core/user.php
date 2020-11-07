<?php

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

    public function getBalance()
    {
        return $this->user['balance'];
    }
}
