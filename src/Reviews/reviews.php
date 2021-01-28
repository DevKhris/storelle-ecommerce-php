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
    /**
     * @var App\Core\Database database
     */
    private Database $db;

    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->db = new Database;

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
          // save query to reviews array
        $reviews = $this->db->select('reviews', "productId = $productId");
        // encode reviews array to json
        $json = json_encode($reviews);
        // Returns the reviews json
        return $json;
    }
}
