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

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $reviews = $row;
        }
        return $reviews;
    }

    public static function getAverage($productId)
    {
        global $conn;

        $sql = "SELECT AVG(rating) AS t_rating, COUNT(*) AS t_reviews FROM reviews WHERE productId = $productId";

        $result = mysqli_query($conn, $sql);

        $rating = mysqli_fetch_assoc($result);

        return $rating;
    }
}
