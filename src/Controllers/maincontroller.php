<?php

namespace App\Controllers;

use App\Application;
use App\Core\Request;

class MainController
{

	public static function home()
	{
		return Application::$app->router->renderView('home');
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
