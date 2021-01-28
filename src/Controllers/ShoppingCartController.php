<?php

namespace App\Controllers;

use App\Application;
use App\Core\User;
use App\Cart\ShoppingCart;

/**   
 * Shopping Cart Controller
 */
class ShoppingCartController
{

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
     * Get for shopping cart requests
     *
     * @return array json
     */
    public static function get()
    {
        if (isset($_SESSION['uid'])) {
            // get cart from user id
            $uid = $_SESSION['uid'];
            // return shopping cart
            $shoppingCart = ShoppingCart::get($uid);
            // return cart
            return $shoppingCart;
        }
    }

    /**
     * Add to Shopping Cart function
     *
     * @return void
     */
    public static function add()
    {
        // decode json from request
        $product = json_decode($_REQUEST['product'], true);
        // get user id from session
        $uid = $_SESSION['uid'];
        // get values from product array
        $data = array(
            'uid' => $uid,
            'pid' => $product['productId'],
            'name' => $product['productName'],
            'quantity' => $product['productQuantity'],
            'price' => $product['productPrice']
        );
        // add product to cart from values
        ShoppingCart::add($data);
    }

    public static function remove()
    {
        if (isset($_REQUEST['id'])) {
            // remove item from cart by id
            $this->cart->remove($_REQUEST['id']);
        }
    }

    public static function checkout()
    {
        if (isset($_REQUEST['checkout'])) {
            // get user id from session
            $uid = $_SESSION['uid'];
            // get data from request
            $data[] = $_REQUEST['checkout'];
            // get cost from array key
            $cost = $data[0]['totalPrice'];
            // calculate final balance from session and store to var
            $balance = ($_SESSION['balance'] - $cost);
            // save balance from user id
            User::setBalance($balance, $uid);
            // do the checkout
            $res = ShoppingCart::checkout($uid);
            // return response
            return $res;
        }
    }
}
