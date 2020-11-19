<?php
/**
 * Class Product for fetching product from db extended from BaseProduct model
 * 
 * @package RubyNight\App\Products;
 * 
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */
namespace App\Products;

use App\Model\BaseProduct;
use App\Reviews\Reviews;

class Product extends BaseProduct
{
    /**
     * [get's product from database by id]
     * @param  [int] $productId [product id to get]
     * 
     * @return [obj]            [json]
     */
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
        // get average rating from product 
        $rating = Reviews::getAverage($productId);
        // round value from array and convert to int
        $rating = floor($rating['t_rating']);
        // declare product var as array
        $product = array();

        // go towards every row and fetch from result
        while ($row = mysqli_fetch_array($result)) {
            // put values to array
            $product[] = array(
                'id' => $row['id'],
                'name' => $row['productName'],
                'img' => $row['productImg'],
                'price' => $row['productPrice'],
                'rating' => $rating,
            );
        }
        // encode product array to json
        $jsonProduct = json_encode($product);
        // Returns the product json
        echo $jsonProduct;
    }

    /**
     * [set values from self (draft)]
     */
    public function set()
    {
        $productId = $this->product['id'];
        $productName = $this->product['name'];
        $productPrice = $this->product['price'];
        $productImg = $this->product['img'];
    }
}
