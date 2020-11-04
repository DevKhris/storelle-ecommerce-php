<?php

namespace App\Products;

use App\Model\BaseProduct;

class GetProducts extends BaseProduct
{
    public $products = [];
    public static function getProducts()
    {
        global $conn;

        $sql = "SELECT * FROM products WHERE id";

        $result = mysqli_query($conn, $sql);

        while($row = \mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            $products[] = $row;
        }
        // return product as a array
        return $products;
    }
}
