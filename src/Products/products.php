<?php
/**
 * Class Products for fetching all products from db extended from BaseProduct model
 *
 * @package RubyNight\App\Products;
 *
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */

namespace App\Products;

class Products
{
    // declare products as array
    public $products = [];

    /**
     * [__construct function for products]
     *
     * @param [array] $products [products array]
     *
     * @return $this->products products instance
     */
    public function __construct($products)
    {
        return $this->products = $products;
    }

    /**
     * [get all products from database]
     *
     * @return [array] [json]
     */
    public static function get()
    {
        global $conn;
        // sql query for all products in db
        $sql = "SELECT * FROM products";

        // go towards every row and fetch from result
        foreach ($conn->query($sql) as $row) {
                $products[] = array(
                'id' => $row['id'],
                'name' => $row['productName'],
                'img' => $row['productImg'],
                'price' => $row['productPrice'],
                'rating' => $row['productRating'],
                );
        }
        // encode products array to json
        $json = json_encode($products);
        echo (string) $json;
        // Returns the products json
        return $json;
    }
}
