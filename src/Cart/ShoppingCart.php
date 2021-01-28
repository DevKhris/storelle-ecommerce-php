<?php

/**
 * Class ShoppingCart extended from BaseCart model
 *
 * @package RubyNight\App\Cart;
 *
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */

namespace App\Cart;

use App\Alerts\Alerts;
use App\Core\Database;
use App\Model\BaseCart;

final class ShoppingCart implements BaseCart
{
    /**
     * @var App\Core\Database database
     */
    private Database $db;

    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->db = new Database;

        return $this;
    }

    /**
     * Get the items in the shopping cart from db
     *
     * @param int $userId current user id
     *
     * @return json returns a json with the cart values
     */
    public static function get($userId)
    {
        // fetch shopping cart from db
        $shoppingCart = $this->db->select('shoppingcart', "userId = $userId");

        // encode the array to a json object
        $json = json_encode($shoppingCart);
        // returns json
        return $json;
    }

    /**
     * Add product item to shopping cart
     *
     * @param array $data data from product to add
     *
     * @return void
     */
    public static function add($data)
    {
        // Query to insert the current product into the shopping cart
        $res = $this->db->insert("shoppingcart", "(uid, pid, name, quantity, price)", $data);
        if ($res) {
            // returns success if item was inserted into db
            echo Alerts::shopping_cart_add_success($data['name']);
        }

        // returns error if can't insert item
        echo Alerts::shopping_cart_add_error($data['name']);
    }

    /**
     * Remove selected product by it id from db
     *
     * @param int $id shopping cart id
     *
     * @return string    status
     */
    public static function remove($id)
    {
        // Query to delete item by id from table and stores the result
        $res =  $this->db->delete('shoppingcart', "id = $id");

        if (!$result) {
            // returns error if can't remove item
            echo Alerts::shopping_cart_remove_error();
        }
        // returns success if item was removed from db
        echo Alerts::shopping_cart_remove_success();
    }

    public static function checkout($userId)
    {
        // Query for deleting item from cart after purchase
        $result = $this->db->delete('shoppingcart', $userId);
        // Stores the result of query
        if (!$result) {
            // returns error if can't process the cart
            echo Alerts::shopping_cart_checkout_error();
        }
        // returns success if query is successfull
        echo Alerts::shopping_cart_checkout_success();
    }
}
