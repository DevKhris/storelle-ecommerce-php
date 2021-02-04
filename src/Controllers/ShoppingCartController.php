<?php

namespace App\Controllers;

use App\Application;
use App\Core\User;
use App\Models\Cart\ShoppingCart;

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
        if (isset($_SESSION['id'])) {
            // get cart from user id
            $id = $_SESSION['id'];
            // return shopping cart
            $shoppingCart = new ShoppingCart($id);
            // return cart
            return $shoppingCart->cart;
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
        $data = json_decode($_REQUEST['product'], true);
        // get user id from session
        $userId = $_SESSION['id'];
        // add user id to data array
        $data['userId'] = $userId;
        $shoppingCart = new ShoppingCart($userId);
        // add product to cart from array
        $shoppingCart->add($data);
    }

    public static function remove()
    {
        $userId = $_SESSION['id'];

        $shoppingCart = new ShoppingCart($userId);
        // remove item from cart by id
        $shoppingCart->remove($_REQUEST['id']);
    }

    public static function checkout()
    {
        if (isset($_REQUEST['checkout'])) {
            // get user id from session
            $id = $_SESSION['id'];
            // get data from request
            $data[] = $_REQUEST['checkout'];
            // get cost from array key
            $cost = $data[0]['totalPrice'];
            // calculate final balance from session and store to var
            $balance = ($_SESSION['balance'] - $cost);
            // save balance from user id
            $user = new User($_SESSION['username'], $balance);
            // do the checkout
            $shoppingCart = new ShoppingCart($id);
            $result = $shoppingCart->checkout($id);
            // set user balance
            $user->setBalance($balance, $id);
            $_SESSION['balance'] = $balance;
            // return response
            return $result;
        }
    }
}
