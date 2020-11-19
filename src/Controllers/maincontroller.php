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
     * [shoppingcartHandler description]
     * @return [type] [description]
     */
    public static function shoppingcartHandler()
    {
        if (isset($_REQUEST['product'])) {
            $product = json_decode($_REQUEST['product'], true);
            $userId = $_SESSION['uid'];
            $productId = $product['productId'];
            $productName = $product['productName'];
            $productQuantity = $product['productQuantity'];
            $productPrice = $product['productPrice'];
            ShoppingCart::addToCart($userId, $productId, $productName, $productQuantity, $productPrice);
            return;
        }

        if (isset($_REQUEST['id'])) {
            ShoppingCart::removeFromCart($_REQUEST['id']);
            return;
        }

        if (isset($_SESSION['uid'])) {
            $res = ShoppingCart::getCart($_SESSION['uid']);
        }

        if (isset($_REQUEST['checkout'])) {
            $userId = $_SESSION['uid'];
            $data[] = $_REQUEST['checkout'];
            $cost = $data[0]['totalPrice'];
            $balance = ($_SESSION['balance'] - $cost);
            User::setBalance($balance, $userId);
            $res = ShoppingCart::checkOut($userId);
            return;
        }
    }

    public static function reviews()
    {

        return Application::$app->router->renderView('reviews');
    }

    public static function reviewsHandler()
    {
        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            $res = [];
            $res = Reviews::getReviews($id);
            return $res;
        }
    }

    public static function reviewHandler()
    {
        if (isset($_REQUEST['review'])) {
            $review = json_decode($_REQUEST['review'], true);
            $productId = $review['productId'];
            $reviewUserName = $_SESSION['name'];
            $reviewFeedBack = $review['feedBack'];
            $reviewRating = $review['rating'];
            Review::addReview($productId, $reviewUserName, $reviewFeedBack, $reviewRating);
        }
    }
    public static function contact()
    {
        return Application::$app->router->renderView('contact');
    }


    public function contactHandler(Request $req)
    {
        $body = $req->getBody();
        return $body;
    }

    public static function about()
    {
        return Application::$app->router->renderView('about');
    }

    public static function profileHandler()
    {
        if (isset($_REQUEST['balance'])) {
            $req = [];
            $req = User::getBalance($_SESSION['name']);
        }
        return $req;
    }
}
