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
    // declare reviews as array
    public $reviews = [];
    // declare rating var
    public $rating;

    /**
     * [getReviews get all review from product by id]
     * @param [int] $productId [product id]
     * 
     * @return [obj]            [json]
     */
    public static function getReviews($productId)
    {
        global $conn;
        // query for select all review from database by id
        $sql = "SELECT * FROM reviews WHERE productId = $productId";

        // do the query and store the result
        $result = mysqli_query($conn, $sql);
        // checks if result has value
        if (!$result) {
            // thrown warning
            echo ('Warning, can\'t fetch reviews');
        }
        // go towards every row and fetch from result as an associative array
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            // save reviews as a array and assign values to it from row
            $reviews[] = array(
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
        echo $jsonReviews;
    }

    /**
     * [getAverage  get average rating from reviews of a product]
     * @param [int] $productId [product id]
     * 
     * @return [array]            [rating]
     */
    public static function getAverage($productId)
    {
        global $conn;
        // query for getting average rating from reviews of a product
        $sql = "SELECT AVG(rating) AS t_rating, COUNT(*) AS t_reviews FROM reviews WHERE productId = $productId";

        // store query result
        $result = mysqli_query($conn, $sql);
        // verify if result has value
        if (!$result) {
             // thrown warning
            die('Warning, can\'t fetch average rating for product');
        }
        // fetch associative array and store into var
        $rating = mysqli_fetch_assoc($result);
        // returns array
        return $rating;
    }
}
