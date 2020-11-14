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
                'name' => $row['product_name'],
                'img' => $row['product_img'],
                'price' => $row['product_price'],
                'rating' => $row['product_rating'],
            );
        }

        $jsonProducts = json_encode($products);

        echo $jsonProducts;
    }
}
