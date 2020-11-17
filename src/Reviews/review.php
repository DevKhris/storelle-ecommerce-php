<?php

namespace App\Reviews;

use App\Model\BaseReview;

class Review extends BaseReview
{
    /**
     * Undocumented function
     *
     * @param [int] $productId
     * @param [string] $reviewUserName
     * @param [string] $reviewComment
     * @param [int] $reviewRating
     * @return void
     */
    public static function postReview($productId, $reviewUserName, $reviewFeedBack, $reviewRating)
    {
        global $conn;

        $sql = "INSERT INTO reviews (productId, userName, feedBack, rating) VALUES ('$productId', '$reviewUser', '$reviewFeedBack', '$reviewRating')";

        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }
}
