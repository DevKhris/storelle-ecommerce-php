<?php


namespace App\Interfaces;

/**
 * BaseUser interfase for user methods implementation
 */

interface BaseUser
{
    /**
     * Constructor function for user
     */
    function __construct($username, $balance);

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
    function getBalance($username = null);

    /**
     * Set's the balance of user
     */
    function setBalance($username);
}