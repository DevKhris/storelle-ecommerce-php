<?php
/**
 * BaseCart class for cart implementation
 */
namespace App\Interfaces;

interface ShoppingCartInterface
{
    /**
     * Constructor function
     *
     *
     */
    public function __construct($userId);
    
    /**
     * [getCart description]
     *
     * @param int $userId user id
     *
     * @return json
     */
    public function get($userId);

    /**
     * Remove from Cart Function
     *
     * @param int $id product id
     *
     */
    public function remove($id);

    /**
     * Add to Cart Function
     *
     * @param string $data product data
     *
     */
    public function add($data);

    /**
     * Ccheckout function
     *
     * @param int $userId user id
     *
     */
    public function checkout($userId);
}
