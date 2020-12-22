<?php

/**
 * BaseUser class for user implementation
 */

namespace App\Model;

class BaseUser
{
    // protected vars
    protected $username;
    protected $balance;

    // protected array for user info like username & balance
    protected $user = array('username', 'balance');

    /**
     * [constructor function for user]
     *
     * @param [string] $username user name
     * @param [int]    $balance  user balance
     */
    public function __construct($username, $balance)
    {
    }

    /**
     * [get's the username from user]
     *
     * @return string
     */
    public function getUsername()
    {
    }

    /**
     * [set's the username from user]
     *
     * @param  [string] $username username
     *
     * @return string
     */
    public function setUsername($username)
    {
    }

    /**
     * [get's the balance from user]
     *
     * @return int
     */
    public function getBalance($username = null)
    {
    }

    /**
     * [set's the balance of user]
     *
     * @param [int] $balance balance to set
     *
     * @return int
     */
    public function setBalance($balance)
    {
    }
}