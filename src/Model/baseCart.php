<?php

namespace App\Model;

abstract class BaseCart
{
    public $cart = [];

    /**
     * ShoppingCart constructor.
     * @param array $products
     */
    public function __construct(array $cart)
    {
        $this->cart = $cart;
    }

    public function getCart()
    {
    }

    public function addToCart($productId, $productName, $productPrice)
    {
    }
}
