<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Services\ProductService;

class ProductController extends Controller
{    
    /**
     * Index function
     */
    public function index(ProductService $productService)
    {
        $products = $productService->getAll();

        return $this->view('products.index', compact('products'));
    }

    /**
     * Index function
     */
    public function show(ProductService $productService, int $id)
    {
        $product = $productService->findById($id);
        // $reviews = new Review();
        // $reviews = $reviews->get($id, false);

        $this->view('products.show', compact('product'));
    }
}