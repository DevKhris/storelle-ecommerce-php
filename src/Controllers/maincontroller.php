<?php

namespace App\Controllers;

use App\Application;
use App\Core\Request;
use App\Reviews\Review;
use App\Reviews\Reviews;

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

	public static function product()
	{

		return Application::$app->router->renderView('product');
	}

	public static function productHandler()
	{
		$id = $_POST['id'];
		$qty = $_POST['productQuantity'];
	}

	public static function shoppingcart()
	{
		return Application::$app->router->renderView('shopping-cart');
	}

	public static function review()
	{
		return Application::$app->router->renderView('review');
	}

	public static function reviewHandler()
	{

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id = $_POST['id'];
			$reviewRating = $_POST['reviewRating'];
			$reviewComment = $_POST['reviewContent'];
			$reviewUser = $_SESSION['name'];
			Review::postReview($id, $reviewUser, $reviewComment, $reviewRating);
			\header("location: /product?id=$id");
		} else {
			$id = $_POST['id'];
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
