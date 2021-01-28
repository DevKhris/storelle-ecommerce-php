<?php

/**
 * Class User for building user extended from BaseUser model
 *
 * @package RubyNight\App\Core;
 *
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */

namespace App\Core;

use App\Alerts\Alerts;
use App\Core\Database;
use App\Interfaces\UserInterface;

final class User implements UserInterface
{
    public $username;
    public $balance;
    private Database $db;
    
    public function __construct($username, $balance)
    {
        $this->username = $username;
        $this->balance = $balance;
        $this->db = new Database;

        return $this;
    }
    
    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }
    /**
     * Set Balance function
     *
     * @param int $balance amount to set
     *
     * @return void
     */
    public function setBalance($balance)
    {
        $result = $this->db->update('users', $balance, $_SESSION['uid']);
        if (!empty($result)) {
            return Alert::user_set_balance_success();
        }
        return Alert::user_set_balance_error();
    }

    /**
     * Get Balance
     *
     * @return void
     */
    public function getBalance()
    {
        $return = $this->balance;

        $data = array(
            'balance' => $balance
        );

        $json = json_encode($data);
        return $json;
    }
}
