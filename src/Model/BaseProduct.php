<?php

/**
 * BaseProduct class for product implementation
 */

namespace App\Model;

interface BaseProduct
{
    /**
     * Constructor function
     */
    public function __construct();

    /**
     * Get function
     * 
     * @param int $productId product id
     *
     * @return array json
     */
    public function get($productId);
}
