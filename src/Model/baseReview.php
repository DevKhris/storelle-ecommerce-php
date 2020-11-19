<?php
/**
 * BaseReview class for review implementation
 */
namespace App\Model;

abstract class BaseReview
{
    protected $productId;
    protected $reviewId;
    protected $reviewProductId;
    protected $reviewUserName;
    protected $reviewRating;
    protected $reviewFeedBack;
    /**
     * [__construct constructor funcion]
     * @param [int] $reviewId        [review id]
     * 
     * @param [int] $reviewProductId [product id from review]
     * 
     * @param [string] $reviewUserName  [username]
     * 
     * @param [float] $reviewRating    [rating]
     * 
     * @param [string] $reviewFeedBack  [product feedback]
     */
    public function __construct($reviewId, $reviewProductId, $reviewUserName, $reviewRating, $reviewFeedBack)
    {
        $this->reviewId = $reviewId;
        $this->reviewProductId = $reviewProductId;
        $this->reviewUserName = $reviewUserName;
        $this->reviewRating = $reviewRating;
        $this->reviewFeedBack = $reviewFeedBack;
    }

    /**
     * [getReview interfase]
     * @param  [int] $productId [product id]
     * 
     * @return [obj]            [json]
     */
    public function getReview($productId)
    {
    }
    /**
     * [addReview description]
     * @param [int] $productId      [product id]
     * 
     * @param [string] $reviewUserName [username for review]
     * 
     * @param [float] $reviewRating   [rating for review]
     * 
     * @param [string] $reviewFeedBack [feedback for review]
     */
    public static function addReview($productId, $reviewUserName, $reviewRating, $reviewFeedBack)
    {
    }
}
