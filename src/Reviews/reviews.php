<?php

/**
 * Class Reviews for fetching reviews from db
 * 
 * @package RubyNight\App\Reviews;
 * 
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */

namespace App\Reviews;

use App;
use App\Core\Database;

class Reviews
{
    public function __construct()
    {
        return $this;
    }

    /**
     * Get reviews from product by id
     * 
     * @param int $productId product id
     * 
     * @return json reviews json
     */
    public static function get($productId)
    {
        $db = new Database;
        // save query to reviews array
        $reviews = $db->select('reviews', "productId = $productId");
        // encode reviews array to json
        $json = json_encode($reviews);
        // Returns the reviews json
        return $json;
    }
}