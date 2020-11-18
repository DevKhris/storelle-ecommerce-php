<?php

/**
 * Class ShoppingCart extended from BaseCart model
 * 
 * @package RubyNight\App\Cart;
 * 
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */

namespace App\Cart;

use App\Model\BaseCart;

class ShoppingCart extends BaseCart
{
    /**
     * [get the items in the shopping cart from db]
     * 
     * @param [int] $userId [current user id]
     * 
     * @return [json] [returns a json object with the cart values]
     */
    public static function getCart($userId)
    {
        global $conn;
        // query the items in the table and orders it by descendant order
        $sql = "SELECT * FROM shoppingcart WHERE userId = '$userId' ORDER by id DESC";

        // saves the query result to var
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            echo 'Can\'t fetch shopping cart';
        }

        // declare cart as an array
        $cart = array();

        // go to every row in result query and saves to array 
        while ($row = mysqli_fetch_array($result)) {
            $cart[] = array(
                'id' => $row['id'],
                'userId' => $row['userId'],
                'productId' => $row['productId'],
                'productName' => $row['productName'],
                'productQuantity' => $row['productQuantity'],
                'productPrice' => $row['productPrice']
            );
        }

        // encode the array to a json object
        $jsonCart = json_encode($cart);
        // returns json
        echo $jsonCart;
    }

    /**
     * [Add product item to shopping cart]
     * 
     * @param [id] $userId [id from current user]
     * @param [id] $productId [id from product]
     * @param [string] $productName [name of the current product]
     * @param [int] $productQuantity [quantity of products]
     * @param [float] $productPrice [current price]
     * 
     * @return [string]     [validation]
     */
    public static function addToCart($userId, $productId, $productName, $productQuantity, $productPrice)
    {
        global $conn;
        // Query to insert the current product into the shopping cart
        $sql = "INSERT INTO shoppingcart (userId, productId, productName, productQuantity, productPrice) VALUES ('$userId', '$productId', '$productName', '$productQuantity', '$productPrice')";

        // saves the query result to var
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            // returns error if can't insert item
            echo '<div class="alert alert-warning alert-dismissible" role="alert">Can\'t add ' . $productName . ' to cart</div>';
        }
        // returns success if item was inserted into db
        echo '<div class="alert alert-success alert-dismissible" role="alert">Succesfully added ' . $productName . ' to cart</div>';
    }

    /**
     * [remove selected product by it id from db]
     * 
     * @param [int] $id [entry id]
     * 
     * @return [string]     [validation]
     */
    public static function removeFromCart($id)
    {
        global $conn;
        // Query to delete item by id from table
        $sql = "DELETE FROM shoppingcart WHERE id = '$id'";

        // Stores the query result
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            // returns error if can't remove item
            echo '<div class="alert alert-warning" role="alert">Can\'t remove from cart</div>';
        }
        // returns success if item was removed from db
        echo '<div class="alert alert-success" role="alert">Removed from cart!</div>';
    }

    public static function checkOut($userId)
    {
        global $conn;
        // Query for deleting item from cart after purchase
        $sql = "DELETE FROM shoppingcart WHERE userId = '$userId'";

        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo '';
        }
        echo '';
    }
}
