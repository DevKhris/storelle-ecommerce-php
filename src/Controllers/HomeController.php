<?php

/**

 */

namespace App\Controllers;

use App\Controllers\Controller;
use App\Services\ProductService;

class HomeController extends Controller
{
    /**
     * Index function
     */
    public function index(ProductService $productService)
    {
        $products = $productService->getAll();

        return $this->view('home', compact('products'));
    }
}