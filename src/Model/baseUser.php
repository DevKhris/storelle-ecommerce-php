<?php

namespace App\Model;

/**
 * BaseUser class for user implementation
 */
abstract class BaseUser
{
  // protected vars
  protected $username;
  protected $password;
  protected $balance;

  // protected array for user info like username & balance
  protected $user = array('username', 'password', 'balance');

  /**
   * Constructor function for user
   *
   * @param    [string] $username
   * @param    [hash] $password
   * @param    [int] $balance
   * 
   */
  public function __construct($username, $password, $balance)
  {
    $this->user['username'] = $username;
    $this->user['password'] = $password;
    $this->user['balance'] = $balance;
  }

  /**
   * GetUsername function
   * get's the username from user
   * @return string
   */
  public function getUsername($username)
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
   * GetPassword function
   * get's the password from user
   * @return hash
   */
  public function getPassword($password)
  {
  }

  /**
   * SetPassword function
   * set's the password from user
   * @return hash
   */
  public function setPassword($password)
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
  public static function getBalance($username)
  {
  }

  /**
   * SetBalance function
   * set's the balance of user
   * @return int
   */
  public static function setBalance($balance, $uid)
  {
  }
}
