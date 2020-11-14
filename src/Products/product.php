<?php

namespace App\Products;

use App\Model\BaseProduct;
use App\Reviews\Reviews;

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

        if (!$result) {
            echo 'Can\'t fetch product';
        }
        $rating = Reviews::getAverage($productId);
        $rating = floor($rating['t_rating']);
        $product = array();

        while ($row = mysqli_fetch_array($result)) {
            $product[] = array(
                'id' => $row['id'],
                'name' => $row['productName'],
                'img' => $row['productImg'],
                'price' => $row['productPrice'],
                'rating' => $rating,
            );
        }

        $jsonProduct = json_encode($product);
        // Returns the product json
        echo $jsonProduct;
    }

    public static function set()
    {
        $productId = $this->product['id'];
        $productName = $this->product['name'];
        $productPrice = $this->product['price'];
        $productImg = $this->product['img'];
    }
}
