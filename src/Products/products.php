<?php
/**
 * Class Products for fetching all products from db extended from BaseProduct model
 * 
 * @package RubyNight\App\Products;
 * 
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */
namespace App\Products;

use App\Model\BaseProduct;

class Products extends BaseProduct
{
    //declare products as array
    public $products = [];
    
    /**
     * [getProducts get all products from database]
     * 
     * @return [obj] [json]
     */
    public static function getProducts()
    {
        global $conn;
        // sql query for all products in db
        $sql = "SELECT * FROM products";

        // store query result in array
        $result = mysqli_query($conn, $sql);

        // verify if result has value or is empty
        if (!$result) {
            // thrown warning
            die('Warning, can\'t fetch products!');
        }

        // go towards every row and fetch from result
        while ($row = mysqli_fetch_array($result)) {
            // save products as a array and assign values to it from row
            $products[] = array(
                'id' => $row['id'],
                'name' => $row['productName'],
                'img' => $row['productImg'],
                'price' => $row['productPrice'],
                'rating' => $row['productRating'],
            );
        }
        // encode products array to json
        $jsonProducts = json_encode($products);
        // Returns the products json
        echo $jsonProducts;
    }
}
