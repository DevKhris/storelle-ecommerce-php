<?php

namespace App\Model;

abstract class BaseCart
{
    public $products = [];

    /**
     * ShoppingCart constructor.
     * @param array $products
     */
    public function __construct(array $products)
    {
        $this->products = $products;
    }
}
