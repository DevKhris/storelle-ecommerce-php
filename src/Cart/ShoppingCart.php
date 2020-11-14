<?php

namespace App\Cart;

use App\Model\BaseCart;

class ShoppingCart extends BaseCart
{
    public static function addToCart($userId, $productId, $productName, $productQuantity, $productPrice)
    {
        $sql = "INSERT INTO shoppingcart ($userId, $productId, productName, productQuantity, productPrice) VALUES ('$userId', '$productId', '$productName', '$productQuantity', '$productPrice')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo '<div class="alert alert-success" role="alert">Added to cart!</div>';
        } else {
            echo '<div class="alert alert-warning" role="alert">Can\'t add to cart</div>';
        }
    }
    public static function removeFromCart($id)
    {
        $sql = "DELETE * FROM shoppingcart WHERE id = '$id'";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo '<div class="alert alert-success" role="alert">Removed from cart!</div>';
        } else {
            echo '<div class="alert alert-warning" role="alert">Can\'t remove from cart</div>';
        }
    }
    public static function getCart($userId)
    {
        $sql = "SELECT * FROM shoppingcart WHERE userId = '$userId' ORDER by id ASC";

        $result = mysqli_query($conn, $sql);

        while ($row = \mysqli_fetch_array($result)) {
            $cart[] = $row;
        }
        $jsonCart = json_encode($cart);
        echo $jsonCart;
    }
}
