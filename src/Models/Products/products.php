<?php

/**
 * Class Products for fetching all products from db extended from BaseProduct model
 *
 * @package RubyNight\App\Products;
 *
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */

namespace App\Models\Products;

use App\Core\Database;

class Products
{
    /**
     * @var App\Core\Database database
     */
    public Database $db;
    /**
     * Constructor function for products
     *
     * @return products from this get instance
     */
    public function __construct()
    {
        $this->db = new Database();
        return $this->get();
    }

    /**
     * Get all products from database
     *
     * @return array json
     */
    public function get()
    {
        
        // fetch products from db
        $products = $this->db->select('products');
        // // encode products array to json
        $json = json_encode($products);
        // // Returns the products json
        return $json;
    }
}