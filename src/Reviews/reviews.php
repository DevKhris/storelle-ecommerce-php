<?php

/**
 * Class Reviews for fetching reviews from db
 * 
 * @package RubyNight\App\Reviews;
 * 
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */

namespace App\Reviews;

class Reviews
{
    public function __construct($productId)
    {
        return $this->reviews = $this->get($productId);
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
        global $conn;
        // query for select all review from database by id
        $sql = "SELECT * FROM reviews WHERE productId = ?";
        // prepare the query
        $stmt = $conn->prepare($sql);
        // do the query and store the result
        $result = $stmt->execute([$productId]);
        // checks if result has value
        if (!$result) {
            // thrown warning
            echo ('Warning, can\'t fetch reviews');
        }
        $result = $stmt->fetchAll();
        var_dump($result);
        // go towards each row and fetch from result to an associative array
        foreach ($result as $row) {
            // save reviews as a array and assign values to it from row
            $reviews = array(
                'id' => $row['id'],
                'productId' => $row['productId'],
                'userName' => $row['userName'],
                'feedBack' => $row['feedBack'],
                'rating' => $row['rating'],
            );
        }
        // encode reviews array to json

        $jsonReviews = json_encode($reviews);
        // Returns the reviews json
        return $jsonReviews;
    }

    /**
     * Get average rating from reviews of a product by id
     * 
     * @param int $productId product id
     * 
     * @return array rating
     */
    public static function avg($productId)
    {
        global $conn;
        // query for getting average rating from reviews of a product
        $sql = "SELECT AVG(rating) AS t_rating, COUNT(*) AS t_reviews FROM reviews WHERE productId = ?";
        // prepare the query
        $stmt = $conn->prepare($sql);
        // store query result
        $result = $stmt->execute([$productId]);
        // verify if result has value
        if (!$result) {
            // thrown warning
            die('Warning, can\'t fetch average rating for product');
        }
        // fetch associative array and store into var
        $rating = $stmt->fetch($result);
        // returns array
        return $rating;
    }
}