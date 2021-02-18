<?php

/**
 *
 */

namespace App\Controllers;

use App\Application;
use App\Core\Request;
use App\Models\Products\Product;

class ProductController
{
    /**
     * Index function
     *
     * @return view render view
     */
    public static function index(Request $req)
    {
        return Application::$app->router->view('product');
    }

    /**
     * Get's the requested product and return it
     *
     * @return $product returns product
     */
    public static function get(Request $req)
    {
        $product = new Product();
        return $product->get($req->params['id']);
    }

    /**
     * Index function
     *
     * @return view render view
     */
    public static function show()
    {
        // render view from router for product
        return Application::$app->router->view('product');
    }

}