<?php
/**
 * BaseUser class for user implementation
 */
namespace App\Model;

abstract class BaseUser
{
    // protected vars
    protected $username;
    protected $password;
    protected $balance;

    // protected array for user info like username & balance
    protected $user = array('username', 'password', 'balance');

    /**
     * [constructor function for user]
     *
     * @param [string] $username
     * 
     * @param [string] $password
     * 
     * @param [int] $balance
    */
    public function __construct($username, $password, $balance)
    {
        $this->user['username'] = $username;
        $this->user['password'] = $password;
        $this->user['balance'] = $balance;
    }

    /**
     * [get's the username from user]
     * 
     * @return string
    */
    public function getUsername($username)
    {
    }

    /**
     * [get's the username from user]
     * 
     * @return string
    */
    public function setUsername($username)
    {
    }

    /**
     * [get's the password from user]
     * 
     * @return hash
    */
    public function getPassword($password)
    {
    }

    /**
     * [set's the password from user]
     * 
     * @return hash
    */
    public function setPassword($password)
    {
    }

    /**
     * [get's the balance from user]
     * 
     * @return int
    */
    public static function getBalance($username)
    {
    }

    /**
     * [set's the balance of user]
     * 
     * @return int
    */
    public static function setBalance($balance, $uid)
    {
    }
}
