<?php

/**
 *
 */

namespace App\Controllers;

use App\Application;
use App\Core\Controller;
use App\Models\Reviews\Review;
use App\Models\Products\Product;

class ProductController extends Controller
{
    /**
     * Index function
     *
     * @return view render view
     */
    public function index($id)
    {
        $product = new Product();
        $product = $product->get($id, false);
        $reviews = new Review();
        $reviews = $reviews->get($id, false);
        // render view from router for product
        $this->view('products.show', compact(['product', 'reviews']));
    }
    /**
     * Get's the requested product and return it
     * @param  $id product id
     * 
     * @return $product returns product
     */
    public function show($id)
    {
        $product = new Product();
        return $product->get($id);
    }
}