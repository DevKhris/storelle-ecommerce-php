<?php

namespace App\Reviews;

class Reviews
{
    public $reviews = [];
    public $rating;
    public static function getReviews($productId)
    {
        global $conn;

        $sql = "SELECT * FROM reviews WHERE productId = $productId";

        $result = mysqli_query($conn, $sql);

        if(!$result) {
            die('Can\'t fetch reviews');    
        }
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $reviews[] = array(
            'id' => $row['id'],
            'productId' => $row['productId'],
            'userName' => $row['userName'],
            'feedBack' => $row['feedBack'],
            'rating' => $row['rating'],
            );
        }

        $jsonReviews = json_encode($reviews);

        echo $jsonReviews;
    }

    public static function getAverage($productId)
    {
        global $conn;

        $sql = "SELECT AVG(rating) AS t_rating, COUNT(*) AS t_reviews FROM reviews WHERE productId = $productId";

        $result = mysqli_query($conn, $sql);
        if (!$result){
            die('Can\'t fetch average rating for product');
        }
        $rating = mysqli_fetch_assoc($result);

        return $rating;
    }
}
