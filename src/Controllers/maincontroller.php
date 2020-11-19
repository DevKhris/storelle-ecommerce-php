<?php
/**
 * Class MainController for handling rendering and callbacks
 * 
 * @package RubyNight\App\Controllers;
 * 
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */

namespace App\Controllers;

use App\Application;
use App\Core\Request;
use App\Products\Products;
use App\Products\Product;
use App\Reviews\Review;
use App\Reviews\Reviews;
use App\Cart\ShoppingCart;
use App\Core\User;

class MainController
{
    /**
     * [home router render]
     * 
     * @return [view] [renders view] 
     */
    public static function home()
    {
        return Application::$app->router->renderView('home');
    }

    /**
     * [products router render]
     * 
     * @return [view] [renders view]
     */
    public static function products()
    {
        return Application::$app->router->renderView('products');
    }

    /**
     * [productsHandler for requests of products]
     * 
     * @return [json] [returns products]
     */
    public static function productsHandler()
    {
        $res;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // get products and store in var
            $res = Products::getProducts();
            // return response
            return $res;
        }
    }

    /**
     * [product router render]
     * 
     * @return [view] [renders view]
     */
    public static function product()
    {
        return Application::$app->router->renderView('product');
    }

    /**
     * [productHandler for requests of product]
     * 
     * @return [json] [returns product]
     */
    public static function productHandler()
    {
        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            // get product by id and store in var
            $req = Product::get($id);
            // return response
            return $req;
        }
    }

    /**
     * [shoppingcart router render]
     * 
     * @return [view] [renders view]
     */
    public static function shoppingcart()
    {
        return Application::$app->router->renderView('shopping-cart');
    }

    /**
     * [shoppingcartHandler for shopping cart requests]
     * 
     * @return [obj] [json]
     */
    public static function shoppingcartHandler()
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
            // return empty
            return;
        }

        if (isset($_REQUEST['id'])) {
            // remove item from cart by id
            ShoppingCart::removeFromCart($_REQUEST['id']);
            // return empty
            return;
        }

        if (isset($_SESSION['uid'])) {
            // get cart from user id
            $res = ShoppingCart::getCart($_SESSION['uid']);
        }

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
            // return empty
            return;
        }
    }
    
    /**
     * [reviews router render]
     * 
     * @return [view] [renders view]
     */
    public static function reviews()
    {

        return Application::$app->router->renderView('reviews');
    }

    /**
     * [reviewsHandler for reviews requests]
     * 
     * @return [array] [response]
     */
    public static function reviewsHandler()
    {
        if (isset($_REQUEST['id'])) {
            // get id from requests
            $id = $_REQUEST['id'];
            $res = [];
            // get reviews and save to response var from id
            $res = Reviews::getReviews($id);
            // return response
            return $res;
        }
    }

    /**
     * [reviewHandler for review requests]
     * 
     * @return [type] [description]
     */
    public static function reviewHandler()
    {
        if (isset($_REQUEST['review'])) {
            // decode json from request
            $review = json_decode($_REQUEST['review'], true);
            // set values from array keys
            $productId = $review['productId'];
            // assign name from current user in session
            $reviewUserName = $_SESSION['name'];
            $reviewFeedBack = $review['feedBack'];
            $reviewRating = $review['rating'];
            // add review to db call
            Review::addReview($productId, $reviewUserName, $reviewFeedBack, $reviewRating);
        }
    }

    /**
     * [contact router render]
     * 
     * @return [view] [render view]
     */
    public static function contact()
    {
        // render view from router for contact
        return Application::$app->router->renderView('contact');
    }

    /**
     * [contactHandler for contact requests]
     * @param Request $req [request]
     * 
     * @return [array]       [body]
     */
    public function contactHandler(Request $req)
    {
        // get body from requests
        $body = $req->getBody();
        // return body
        return $body;
    }

    /**
     * [about router render]
     * 
     * @return [view] [render view]
     */
    public static function about()
    {
        // render view from router for about
        return Application::$app->router->renderView('about');
    }

    /**
     * [profileHandler for profile requests]
     * 
     * @return [array] [request]
     */
    public static function profileHandler()
    {
        if (isset($_REQUEST['balance'])) {
            $req = [];
            // get balance from current user in session and store
            $req = User::getBalance($_SESSION['name']);
        }
        // return requests
        return $req;
    }
}
