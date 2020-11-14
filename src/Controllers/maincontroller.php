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
			echo $req;
		}
	}
	public static function shoppingcart()
	{
		return Application::$app->router->renderView('shopping-cart');
	}

	public static function shoppingcartHandler()
	{
		$res;
		$res = ShoppingCart::getCart(2);
		return $res;
	}

	public static function review()
	{

		return Application::$app->router->renderView('review');
	}

	public static function reviewHandler()
	{

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id = $_REQUEST['id'];
			$reviewRating = $_POST['reviewRating'];
			$reviewComment = $_POST['reviewContent'];
			$reviewUser = $_SESSION['name'];
			Review::postReview($id, $reviewUser, $reviewComment, $reviewRating);
			\header("location: /product?id=$id");
		} else {
			$id = $_REQUEST['id'];
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
