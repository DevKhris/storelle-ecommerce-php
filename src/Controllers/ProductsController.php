<?php

namespace App\Controllers;

use App\Application;
use App\Core\Request;
use App\Core\User;
use App\Products\Products;
use App\Controllers\ShoppingCartController;

class ProductsController
{
     /**
     * [products router render]
     *
     * @return [view] [renders view]
     */
    public static function index()
    {
        // render view from router for products
        return Application::$app->router->renderView('products');
    }

     /**
     * [get  requests of products]
     *
     * @return [json] [returns products]
     */
    public static function get()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // get products and store in var
            $res = Products::getProducts();
            // return response
            return $res;
        }
    }
}
