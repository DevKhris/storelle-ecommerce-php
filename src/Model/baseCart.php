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

    public static function getCart($userId)
    {
    }

    public static function removeFromCart($id)
    {
    }

    public static function addToCart($userId, $productId, $productName, $productQuantity, $productPrice)
    {
    }

    public static function checkOut()
    {
    }
}
