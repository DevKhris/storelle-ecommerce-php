<?php

namespace App\Cart;

use App\Model\BaseCart;

class ShoppingCart extends BaseCart
{
    global $conn;
    public static function addToCart($productId, $productName, $productQuantity, $productPrice)
    {
        $sql = "INSERT INTO shoppingcart (productId, productName, productQuantity, productPrice) VALUES ('$productId', '$productName', $productQuantity, '$productPrice')";

        $query = mysqli_query($conn, $sql);

        if ($query === true){
            echo '<div class="alert alert-success" role="alert">Added to cart!</div>';
        } else {
            echo '<div class="alert alert-warning" role="alert">Can\'t add to cart</div>';
        }
    }
    public static function removeFromCart($id)
    {
        $sql = "DELETE FROM shoppingcart WHERE id = $id";

        $query = mysqli_query($conn,$sql);

        if ($query === true){
            echo '<div class="alert alert-success" role="alert">Removed from cart!</div>';
        } else {
            echo '<div class="alert alert-warning" role="alert">Can\'t remove from cart</div>';
        }
    }
}

?>