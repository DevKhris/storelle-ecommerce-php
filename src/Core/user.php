<?php

namespace App\Core;

use App\Model\BaseUser;

class User extends BaseUser
{
    public BaseUser $user;
    public $username;
    public $balance;

    public function setUsername($username)
    {
        $this->user['username'] = $username;
    }
    public function getUsername($username)
    {
        return $this->user['username'];
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
