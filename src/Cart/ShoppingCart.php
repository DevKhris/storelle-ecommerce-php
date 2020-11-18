<?php

namespace App\Cart;

use App\Model\BaseCart;

class ShoppingCart extends BaseCart
{

    public static function addToCart($userId, $productId, $productName, $productQuantity, $productPrice)
    {
        global $conn;

        $sql = "INSERT INTO shoppingcart (userId, productId, productName, productQuantity, productPrice) VALUES ('$userId', '$productId', '$productName', '$productQuantity', '$productPrice')";

        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo '<div class="alert alert-warning alert-dismissible" role="alert">Can\'t add ' . $productName . ' to cart</div>';
        }
        echo '<div class="alert alert-success alert-dismissible" role="alert"> Succesfully added ' . $productName . ' to cart</div>';
    }

    public static function removeFromCart($id)
    {
        global $conn;
        $sql = "DELETE FROM shoppingcart WHERE id = '$id'";

        $result = mysqli_query($conn, $sql);

        if (!$result) {
            echo '<div class="alert alert-warning" role="alert">Can\'t remove from cart</div>';
        }
        echo '<div class="alert alert-success" role="alert">Removed from cart!</div>';
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
                'userId' => $row['userId'],
                'productId' => $row['productId'],
                'productName' => $row['productName'],
                'productQuantity' => $row['productQuantity'],
                'productPrice' => $row['productPrice']
            );
        }

        $jsonCart = \json_encode($cart);
        echo $jsonCart;
    }
}
