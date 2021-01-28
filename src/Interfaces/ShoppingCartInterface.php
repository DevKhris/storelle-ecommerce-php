<?php
/**
 * BaseCart class for cart implementation
 */
namespace App\Interfaces;

interface ShoppingCartInterface
{
    public $cart = [];

    /**
     * Constructor function
     *
     * @param array $cart
     *
     */
    public function __construct(array $cart);
    
    /**
     * [getCart description]
     *
     * @param int $userId user id
     *
     * @return json
     */
    public static function get($userId);

    /**
     * Remove from Cart Function
     *
     * @param int $id product id
     *
     */
    public static function remove($id);

    /**
     * Add to Cart Function
     *
     * @param int    $userId          user id
     * @param int    $productId       product id
     * @param string $productName     product name
     * @param int    $productQuantity product quantity
     * @param float  $productPrice    product price
     *
     */
    public static function add($userId, $productId, $productName, $productQuantity, $productPrice);
    /**
     * Ccheckout function
     *
     * @param int $userId user id
     *
     */
    public static function checkout($userId);
}
