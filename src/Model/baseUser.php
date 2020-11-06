<?php

namespace App\Model;

/**
 * BaseUser class for user implementation
 */
abstract class BaseUser
{
  // protected vars
  protected $username;
  protected $balance;

  // protected array for user info like username & balance
  protected $user = array('username', 'balance');

  /**
   * Constructor function for user
   *
   * @param    [string] $username
   * @param    [int] $balance
   */
  public function __construct($username, $balance)
  {
    $this->user['username'] = $username;
    $this->user['balance'] = $balance;
  }

  /**
   * GetUsername function
   * get's the username from user
   * @return string
   */
  public function getUsername()
  {
  }

  /**
   * SetUsername function
   * get's the username from user
   * @return string
   */
  public function setUsername($username)
  {
  }

  /**
   * Setter & Getter functions for user balance
   */

  /**
   * GetBalance function
   * get's the balance from user
   * @return int
   */
  public function getBalance()
  {
  }

  /**
   * SetBalance function
   * set's the balance of user
   * @return int
   */
  public function setBalance($balance)
  {
  }
}
