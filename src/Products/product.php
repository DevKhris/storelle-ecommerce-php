<?php

namespace App\Products;

use App\Model\BaseProduct;

class Product extends BaseProduct
{

    public static function get($productId)
    {
        global $conn;
        // Query to get Id from products table
        $sql = "SELECT * FROM products WHERE id='$productId'";
        // Saves the result of the query
        $result = mysqli_query($conn, $sql);
        // Fetch result to product
        $product = mysqli_fetch_assoc($result);
        // Returns the product
        return $product;
    }

    public static function set()
    {
        $productId = $this->product[0];
        $productName = $this->product[1];
        $productPrice = $this->product[2];
        $productImg = $this->product[3];
    }
}
