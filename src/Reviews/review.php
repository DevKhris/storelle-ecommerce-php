<?php

namespace App\Reviews;

use App\Model\BaseReview;

class Review extends BaseReview
{
    /**
     * addReview function
     *
     * @param [int] $productId
     * @param [string] $reviewUserName
     * @param [string] $reviewFeedBack
     * @param [int] $reviewRating
     * @return void
     */

    public static function addReview($productId, $reviewUserName, $reviewFeedBack, $reviewRating)
    {
        global $conn;

        $sql = "INSERT INTO reviews (productId, userName, feedBack, rating) VALUES ('$productId', '$reviewUserName', '$reviewFeedBack', '$reviewRating')";

        $result = mysqli_query($conn, $sql);
        if (!$result) {
            die('Can\'t add user review');
        }
        return $result;
        return $_SESSION;
    }
}
