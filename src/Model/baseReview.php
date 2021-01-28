<?php

/**
 * BaseReview class for review implementation
 */

namespace App\Model;

class BaseReview
{
    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->reviewId = $reviewId;
        $this->productId = $productId;
        $this->username = $username;
        $this->rating = $rating;
        $this->feedBack = $feedBack;
    }

    /**
     * Get reviews interfase
     *
     * @param  int $productId product id
     *
     * @return array json
     */
    public function get($productId)
    {
    }
    /**
     * Add Review interfase
     *
     * @param int $productId      product id
     * @param string $userName username for review
     * @param float $rating   rating for review
     * @param  string $feedBack feedback for review
     *
     */
    public function add($productId, $username, $feedback, $rating)
    {
    }
}
