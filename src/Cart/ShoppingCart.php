<?php

namespace App\Cart;

use App\Model\BaseCart;

class ShoppingCart extends BaseCart
{

    public static function addToCart($userId, $productId, $productName, $productQuantity, $productPrice)
    {
        global $conn;
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
        global $conn;
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
        global $conn;
        $sql = "SELECT * FROM shoppingcart WHERE userId = '$userId' ORDER by id DESC";

        $result = mysqli_query($conn, $sql);

        if (!$result) {
            echo 'Can\'t fetch shopping cart';
        }

        $cart = array();
        while ($row = mysqli_fetch_array($result)) {
            $cart[] = array(
                'id' => $row['id'],
                'uId' => $row['userId'],
                'pId' => $row['productId'],
                'name' => $row['productName'],
                'quantity' => $row['productQuantity'],
                'price' => $row['productPrice']
            );
        }

        $jsonCart = \json_encode($cart);
        echo $jsonCart;
    }
}
