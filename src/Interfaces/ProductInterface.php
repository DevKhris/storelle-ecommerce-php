<?php

/**
 * BaseProduct class for product implementation
 */

namespace App\Interfaces;

interface ProductInterface
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
