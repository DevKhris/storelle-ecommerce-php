<?php

/**
 * Class Product for fetching product from db extended from BaseProduct model
 *
 * @package RubyNight\App\Products;
 *
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */

namespace App\Products;

use App\Core\Database;
use App\Model\BaseProduct;

final class Product implements BaseProduct
{
    private Database $db;
    /**
     * Constructor function
     *
     * @return $this
     */
    public function __construct()
    {
        $this->db =  new Database;
        return $this;
    }
    /**
     * [get's product from database by id]
     *
     * @param int $productId product id to get
     *
     * @return json
     */
    public function get($productId)
    {
        // fetch products from db
        $product = $db->select('products', "id=$productId");

        // get average rating from product
        $average = $db->average('rating', 't_rating', 'reviews', 't_reviews', "productId = $productId");

        // round value from array and convert to int
        $rating = floor($average[0]['t_rating']);
        // go towards every row from result

        // put values to array
        $product = array_replace($product[0], array('rating' => $rating));

        // encode product array to json
        $json = json_encode($product);

        // Returns the product json
        return $json;
    }
}
