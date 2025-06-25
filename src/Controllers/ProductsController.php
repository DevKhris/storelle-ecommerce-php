<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Products\Products;

/**
 * Class ProductsController for request products
 *
 * @package RubyNight\App\Controllers;
 *
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */
class ProductsController extends Controller
{
    /**
     * Render view
     *
     * @return view renders view
     */
    public function index()
    {
        // render view from router for products
        return $this->view('products.index');
    }

    /**
     * Get products from db
     *
     * @return array $products
     */
    public function show()
    {
        // declare a new products object
        $products = new Products();
        // return products
        echo $products->get();
    }
}