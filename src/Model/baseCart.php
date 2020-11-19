<?php
/**
 * BaseCart class for cart implementation
 */
namespace App\Model;

abstract class BaseCart
{
    public $cart = [];

    /**
     * [ShoppingCart constructor.]
     * 
     * @param [array] $products
     */
    public function __construct(array $cart)
    {
        $this->cart = $cart;
    }
    
    /**
     * [getCart description]
     * 
     * @param  [int] $userId [user id]
     * 
     * @return [obj]         [json]
     */
    public static function getCart($userId)
    {
    }
    
    /**
     * [removeFromCart description]
     * 
     * @param  [int] $id [product id]
     * 
     */
    public static function removeFromCart($id)
    {
    }

    /**
     * [addToCart description]
     * @param [int] $userId          [user id]
     * 
     * @param [int] $productId     [product id]
     * 
     * @param [string] $productName   [product name]
     * 
     * @param [int] $productQuantity [product quantity]
     * 
     * @param [float] $productPrice  [product price]
     */
    public static function addToCart($userId, $productId, $productName, $productQuantity, $productPrice)
    {
    }

    /**
     * [checkOut description]
     * 
     * @param  [int] $userId [user id]
     * 
     */
    public static function checkOut($userId)
    {
    }
}
