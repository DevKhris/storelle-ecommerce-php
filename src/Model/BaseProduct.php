<?php
/**
 * BaseProduct class for product implementation
 */
namespace App\Model;

abstract class BaseProduct
{
    protected $productId;
    protected $productName;
    protected $productPrice;
    protected $productImg;
    protected $productRating;

    /**
     * [__construct constructor function]
     * @param [int] $productId     [product id]
     *
     * @param [string] $productName   [product name]
     *
     * @param [float] $productPrice  [product price]
     *
     * @param [string] $productImg    [product image]
     *
     * @param [float] $productRating [product rating]
     */
    public function __construct($productId, $productName, $productPrice, $productImg, $productRating)
    {
        $this->productId = $productId;
        $this->productName = $productName;
        $this->productPrice = $productPrice;
        $this->productImg = $productImg;
        $this->productRating = $productRating;
    }

    /**
     * [get function]
     * @param  [int] $productId [product id]
     *
     * @return [obj]            [json]
     */
    public static function get($productId)
    {
    }
}
