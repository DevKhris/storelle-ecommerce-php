<?php

namespace App\Model;

abstract class BaseProduct
{
    protected $productId;
    protected $productName;
    protected $productPrice;
    protected $productImg;
    protected $productRating;

    public function getProduct($productId){}
    public function setProduct(){}
}
?>