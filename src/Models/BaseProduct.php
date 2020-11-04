<?php

namespace App\Products;

abstract class BaseProduct
{
    $product_id;
    $product_name;
    $product_price;
    $product_img;
    $product_rating;

    public function get(){}
}
?>