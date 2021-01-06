<?php

/**
 * BaseProduct class for product implementation
 */

namespace App\Model;

interface BaseProduct
{
    /**
     * Constructor function
     * @param int $productId product id
     */
    public function __construct($productId)
    {
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