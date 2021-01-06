<?php

/**
 * Class Products for fetching all products from db extended from BaseProduct model
 *
 * @package RubyNight\App\Products;
 *
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */

namespace App\Products;

use App\Core\Database;

class Products
{
    /**
     * Constructor function for products
     *
     * @return products from this get instance
     */
    public function __construct()
    {
        return $this->products = $this->get();
    }

    /**
     * Get all products from database
     *
     * @return array json
     */
    public function get()
    {
        // instance of database object
        $db = new Database;
        // fetch products from db
        $products = $db->select('products');
        // // encode products array to json
        $json = json_encode($products);
        // // Returns the products json
        return $json;
    }
}