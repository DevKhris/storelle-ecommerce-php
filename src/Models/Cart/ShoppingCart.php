<?php

/**
 * Class ShoppingCart extended from BaseCart model
 *
 * @package RubyNight\App\Cart;
 *
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */

namespace App\Models\Cart;

use App\Alerts\Alerts;
use App\Core\Database;
use App\Interfaces\ShoppingCartInterface;

final class ShoppingCart implements ShoppingCartInterface
{
    /**
     * @var App\Core\Database database
     */
    private Database $db;

    /**
     * Constructor function
     */
    public function __construct($userId)
    {
        $this->db = new Database;
        $this->cart = $this->get($userId);
        return $this;
    }

    /**
     * Get the items in the shopping cart from db
     *
     * @param int $userId current user id
     *
     * @return json returns a json with the cart values
     */
    public function get($userId)
    {
        // fetch shopping cart from db
        $result = $this->db->select('shoppingcart', "userId = " . $userId);
        // encode the array to a json object
        $json = json_encode($result);
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
    public function add($data)
    {

        $userId = $data['userId'];
        $productId = $data['productId'];
        $name = $data['productName'];
        $price = filter_var($data['productPrice'], FILTER_SANITIZE_URL);
        $quantity = $data['productQuantity'];
        $image = $data['productImage'];
        $product = "'$userId', '$productId', '$name', '$quantity', '$price', '$image'";

        // Query to insert the current product into the shopping cart
        $result = $this->db->insert(
            "shoppingcart",
            "userId, productId, name, quantity, price, image",
            $product
        );

        if ($result) {
            // returns success if item was inserted into db
            echo Alerts::shopping_cart_add_success($name);
        } else {

            // returns error if can't insert item
            echo Alerts::shopping_cart_add_error($name);
        }
    }

    /**
     * Remove selected product by it id from db
     *
     * @param int $id shopping cart id
     *
     * @return string    status
     */
    public function remove($id)
    {
        // Query to delete item by id from table and stores the result
        $result = $this->db->delete('shoppingcart', "id = $id");

        if (!$result) {
            // returns error if can't remove item
            echo Alerts::shopping_cart_remove_error();
        } else {
            // returns success if item was removed from db
            echo Alerts::shopping_cart_remove_success();
        }
    }

    public function checkout($userId)
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