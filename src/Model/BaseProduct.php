<?php

namespace App\Model;

abstract class BaseProduct
{
    protected $productId;
    protected $productName;
    protected $productPrice;
    protected $productImg;
    protected $productRating;

    public function __construct($productId, $productName, $productPrice, $productImg, $productRating)
    {
        $this->productId = $productId;
        $this->productName = $productName;
        $this->productPrice = $productPrice;
        $this->productImg = $productImg;
        $this->productRating = $productRating;
    }

    public function getProduct($productId)
    {
    }
}
