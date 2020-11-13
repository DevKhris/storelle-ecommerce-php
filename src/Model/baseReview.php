<?php

namespace App\Model;

abstract class BaseReview
{
    protected $productId;
    protected $reviewId;
    protected $reviewProductId;
    protected $reviewUsername;
    protected $reviewRating;
    protected $reviewComment;

    public function __construct($reviewId, $reviewProductId, $reviewUsername, $reviewRating, $reviewComment)
    {
        $this->reviewId = $reviewId;
        $this->reviewProductId = $reviewProductId;
        $this->reviewUsername = $reviewUsername;
        $this->reviewRating = $reviewRating;
        $this->reviewComment = $reviewComment;
    }

    public function getReview($productId)
    {
    }

    public static function postReview($productId, $reviewUser, $reviewRating, $reviewComment)
    {
    }
}
