<?php


namespace App\Interfaces;

/**
 * BaseUser interfase for user methods implementation
 */
interface UserInterface
{
    /**
     * Get's the username from user
     */
    function getUsername();

    /**
     * Set's the username from user
     */
    function setUsername($username);


    /**
     * Get's the balance from user
     */
    static function getBalance();

    /**
     * Set's the balance of user
     */
    static function setBalance($username);
}
