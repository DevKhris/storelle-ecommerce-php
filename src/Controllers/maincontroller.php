<?php

namespace App\Controllers;

use App\Application;
use App\Core\Request;
use App\Products\Products;
use App\Products\Product;
use App\Reviews\Review;
use App\Reviews\Reviews;
use App\Cart\ShoppingCart;

class MainController
{

    public static function home()
    {
        return Application::$app->router->renderView('home');
    }

    public static function products()
    {
        return Application::$app->router->renderView('products');
    }

    public static function productsHandler()
    {
        $res;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $res = Products::getProducts();
            return $res;
        }
    }

    public static function product()
    {
        return Application::$app->router->renderView('product');
    }

    public static function productHandler()
    {
        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            $req = Product::get($id);
        }
        
        if(isset($_POST['data'])) {
            var_dump($_POST['data']);
        }
    }
    public static function shoppingcart()
    {
        return Application::$app->router->renderView('shopping-cart');
    }

    public static function shoppingcartHandler()
    {
        // if ($_POST['id']) {
        //  ShoppingCart::removeFromCart($_REQUEST['id']);
        // }
        $res;
        $res = ShoppingCart::getCart($_SESSION['uid']);
        return $res;
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
                    
        if (isset($_POST['review'])) {
            $review = json_($_POST['review']);
            $productId = $_REQUEST['id'];
            $reviewUserName = $_SESSION['name'];
            $reviewRating = $_REQUEST['rating'];
            $reviewFeedBack = $_REQUEST['feedBack'];
            Review::postReview($productId, $reviewUserName, $reviewFeedBack, $reviewRating);
            return $review;
            //\header("location: /product?id=$id");
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
}
