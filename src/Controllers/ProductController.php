<?php

/**
 *
 */

namespace App\Controllers;

use App\Application;
use App\Core\Request;
use App\Products\Product;

class ProductController
{
    /**
     * Index function
     *
     * @return view render view
     */
    public static function index()
    {
        // render view from router for product
        return Application::$app->router->view('product');
    }

    /**
     * Get's the requested product and return it
     *
     * @return json returns product
     */
    public static function get()
    {
        $productId = $_GET['id'];
        // get product by id and store in var
        $product = new Product();
        // return product
        return $product->get($productId);
    }
}
