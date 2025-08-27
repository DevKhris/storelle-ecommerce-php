<?php

/**
 * Class User for building user extended from BaseUser model
 *
 * @package RubyNight\App\Core;
 *
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */

namespace App\Core;

final class User implements UserInterface
{
    /**
     * Set Balance function
     *
     * @param int $balance amount to set
     *
     * @return void
     */
    public function setBalance($balance, $id): string
    {
        $this->db->update('users', "balance = $balance", "id = $id");

        if (!empty($result)) {
            return Alerts::user_set_balance_success();
        }
        return Alerts::user_set_balance_error();
    }

    /**
     * Get Balance
     *
     * @return void
     */
    public function getBalance(): bool|string
    {
        $id = $_SESSION['id'];
        $balance = $this->db->selectFrom('balance', 'users', "id = $id");
        $data = array(
            'balance' => $balance
        );
        $json = json_encode($data);
        return $json;
    }
}