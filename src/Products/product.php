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
     * Constructor function
     *
     * @param int $productId
     * 
     * @return array product array
     */
    public function __construct()
    {
        return $this;
    }
    /**
     * [get's product from database by id]
     *
     * @param [int] $productId product id to get
     *
     * @return [obj]            [json]
     */
    public function get($productId)
    {
        global $conn;
        // Query to get Id from products table with placeholder
        $sql = ("SELECT * FROM products WHERE id=:id");

        // Prepare query statement
        $stmt = $conn->prepare($sql);

        // execute query injecting product id to placeholder
        $stmt->execute([':id' => $productId]);
        // Fetch the result to associative array
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$result) {
            echo 'Can\'t fetch product';
        }
        // get average rating from product
        $rating = Reviews::avg($productId);
        // round value from array and convert to int
        $rating = floor($rating['t_rating']);
        // go towards every row from result
        // put values to array

        $product = array(
            'id' => $result['id'],
            'name' => $result['productName'],
            'img' => $result['productImg'],
            'price' => $result['productPrice'],
            'rating' => $rating,
        );
        // encode product array to json
        $json = json_encode($product);
        // Returns the product json
        return $json;
    }
}