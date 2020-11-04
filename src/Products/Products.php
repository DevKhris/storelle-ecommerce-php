<?php

namespace App\Products;

global $conn;

class Products
{
    public function getProducts($id)
    {
        // Gets the product id
        $productId = $_GET['id'];
        // Query to get Id from products table
        $sql = "SELECT * FROM products WHERE id='$productId'";
        // Saves the result of the query
        $result = mysqli_query($conn, $sql);
        // Fetch result to product
        $product = mysqli_fetch_assoc($result);
        // Returns the product
        return $product;
    }
}
?>