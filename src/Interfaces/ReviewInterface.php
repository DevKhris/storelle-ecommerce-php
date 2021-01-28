<?php

/**
 * Review interface for implementation
 */

namespace App\Interfaces;

interface ReviewInterface
{
    /**
     * Get reviews interfase
     *
     * @param int $productId product id
     *
     * @return array json
     */
    function get($productId);

    
    /**
     * Add Review interfase
     *
     * @param int    $productId product id
     * @param string $username  username for review
     * @param float  $rating    rating for review
     * @param string $feedback  feedback for review
     *
     * @return void
     */
    function add($productId, $username, $rating, $feedback);
}
