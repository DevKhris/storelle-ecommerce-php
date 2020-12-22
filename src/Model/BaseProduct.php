<?php

/**
 * BaseProduct class for product implementation
 */

namespace App\Model;

abstract class BaseProduct
{
    protected $productId;

    /**
     * Constructor function
     * @param [int] $productId     [product id]
     */
    public function __construct($productId)
    {
        $this->productId = $this->get($productId);
    }

    /**
     * Get function
     * 
     * @param int $productId product id
     *
     * @return array json
     */
    public function get($productId)
    {
    }
}