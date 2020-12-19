<?php

namespace App\Controllers;

use App\Application;
use App\Core\Request;
use App\Core\User;
use App\Core\setBalance;
use App\Model\BaseCart;
use App\Cart\ShoppingCart;
use App\Products\Product;
use App\Products\Products;

class ShoppingCartController
{
     /**
     * [index router render]
     *
     * @return [view] [renders view]
     */
    public static function index()
    {
        // render view from router for shopping cart
        return Application::$app->router->renderView('shopping-cart');
        get();
    }

    /**
     * [get for shopping cart requests]
     *
     * @return [obj] [json]
     */
    public static function get()
    {
        if (isset($_SESSION['uid'])) {
            $uid = $_SESSION['uid'];
            // get cart from user id
            $res = ShoppingCart::getCart($uid);
        }
    }
    
    public static function add()
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
            ShoppingCart::addToCart($userId, $productId, $productName, $productQuantity, $productPrice);
        }
    }
    public static function remove()
    {
        if (isset($_REQUEST['id'])) {
            // remove item from cart by id
            ShoppingCart::removeFromCart($_REQUEST['id']);
        }
    }
    
    public static function checkout()
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
            $res = ShoppingCart::checkOut($userId);
            // return response
            return $res;
        }
    }
}
