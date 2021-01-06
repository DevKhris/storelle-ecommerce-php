<?php

namespace App\Controllers;

use App\Application;
use App\Core\User;
use App\Cart\ShoppingCart;

class ShoppingCartController
{
    public function __construct()
    {
        $this->cart = new ShoppingCart;
    }
    /**
     * Index function
     *
     * @return view render view
     */
    public static function index()
    {
        // render view from router for shopping cart
        return Application::$app->router->view('shopping-cart');
    }

    /**
     * [get for shopping cart requests]
     *
     * @return array json
     */
    public function get()
    {
        if (isset($_SESSION['uid'])) {
            // get cart from user id
            $uid = $_SESSION['uid'];

            // return shopping cart
            return $this->cart->get($uid);
        }
    }

    public function add()
    {
        if (isset($_REQUEST['product'])) {
            // decode json from request
            $product = json_decode($_REQUEST['product'], true);
            // get user id from session
            $userId = $_SESSION['uid'];
            // get values from product array
            $productId = $product['productId'];
            $productName = $product['productName'];
            $productQuantity = $product['productQuantity'];
            $productPrice = $product['productPrice'];
            // add product to cart from values
            $this->cart->add($userId, $productId, $productName, $productQuantity, $productPrice);
        }
    }

    public function remove()
    {
        if (isset($_REQUEST['id'])) {
            // remove item from cart by id
            $this->cart->remove($_REQUEST['id']);
        }
    }

    public function checkout()
    {
        if (isset($_REQUEST['checkout'])) {
            // get user id from session
            $userId = $_SESSION['uid'];
            // get data from request
            $data[] = $_REQUEST['checkout'];
            // get cost from array key
            $cost = $data[0]['totalPrice'];
            // calculate final balance from session and store to var
            $balance = ($_SESSION['balance'] - $cost);
            // save balance from user id
            User::setBalance($balance, $userId);
            // do the checkout
            $res = $this->cart->checkout($userId);
            // return response
            return $res;
        }
    }
}