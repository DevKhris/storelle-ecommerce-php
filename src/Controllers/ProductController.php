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
     * [product router render]
     *
     * @return [view] [renders view]
     */
    public static function index()
    {
        // render view from router for product
        return Application::$app->router->renderView('product');
    }

    /**
     * [productHandler for requests of product]
     *
     * @return [json] [returns product]
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