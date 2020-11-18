<?php

namespace App\Model;

abstract class BaseReview
{
    protected $productId;
    protected $reviewId;
    protected $reviewProductId;
    protected $reviewUserName;
    protected $reviewRating;
    protected $reviewFeedBack;

    public function __construct($reviewId, $reviewProductId, $reviewUserName, $reviewRating, $reviewFeedBack)
    {
        $this->reviewId = $reviewId;
        $this->reviewProductId = $reviewProductId;
        $this->reviewUserName = $reviewUserName;
        $this->reviewRating = $reviewRating;
        $this->reviewFeedBack = $reviewFeedBack;
    }

    public function getReview($productId)
    {
    }

    public static function addReview($productId, $reviewUserName, $reviewRating, $reviewFeedBack)
    {
    }
}
