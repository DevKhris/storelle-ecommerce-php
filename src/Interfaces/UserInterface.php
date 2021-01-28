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
     *
     * @param string $username username
     *
     */
    function setUsername($username);


    /**
     * Get's the balance from user
     */
    function getBalance();

    /**
     * Set's the balance of user
     *
     * @param string $username username
     *
     */
    function setBalance($username);
}
