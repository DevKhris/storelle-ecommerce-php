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
use App\Interfaces\BaseUser;

final class User implements UserInterface
{
    private Database $db;
    
    public function __construct()
    {
        $this->db = new Database;
    }
    
    public function getUsername()
    {
        return $_SESSION['username'];
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
    public static function setBalance($balance)
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
    public static function getBalance()
    {
        $data = array(
            'balance' => $_SESSION['balance']
        );

        $json = json_encode($data);
        return $json;
    }
}
