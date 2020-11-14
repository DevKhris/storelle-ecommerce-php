<?php

namespace App\Products;

use App\Model\BaseProduct;

class Products extends BaseProduct
{
    public $products = [];
    public static function getProducts()
    {
        global $conn;

        $sql = "SELECT * FROM products";

        $result = mysqli_query($conn, $sql);

        if (!$result) {
            die('Can\'t fetch products');
        }
        $products = array();
        while ($row = mysqli_fetch_array($result)) {
            // return products as a array
            $products[] = array(
                'id' => $row['id'],
                'name' => $row['productName'],
                'img' => $row['productImg'],
                'price' => $row['productPrice'],
                'rating' => $row['productRating'],
            );
        }

        $jsonProducts = json_encode($products);

        echo $jsonProducts;
    }
}
