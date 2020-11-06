<?php

namespace App\Cart;

use App\Model\BaseCart;

class ShoppingCart
{
    global $conn;
    public static function addToCart($name,$price,$img,$quantity)
    {
        $sql = "INSERT INTO shoppingcart (name,price,img,quantity) VALUES ($name,$price,$img,$quantity)";

        $query = mysqli_query($conn, $sql);

        if ($query === true){
            echo "<div class="alert alert-success" role="alert">Added to cart!</div>";
        } else {
            echo "<div class="alert alert-warning" role="alert">Can't add to cart</div>";
        }
    }
    public static function removeFromCart($id)
    {
        $sql = "DELETE FROM shoppingcart WHERE id = $id";

        $query = mysqli_query($conn,$sql);

        if ($query === true){

            echo "<div class="alert alert-success" role="alert">Removed from cart!</div>";
        } else {
            echo "<div class="alert alert-warning" role="alert">Can't remove from cart</div>";
        }
    }
}

?>