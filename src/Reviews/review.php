<?php

namespace App\Reviews;

use App\Model\BaseReview;

class Review extends BaseReview
{
    /**
     * Undocumented function
     *
     * @param [int] $productId
     * @param [string] $reviewUser
     * @param [string] $reviewComment
     * @param [int] $reviewRating
     * @return void
     */
    public static function postReview($productId, $reviewUser, $reviewComment, $reviewRating)
    {
        global $conn;

        $sql = "INSERT INTO reviews (productId, user_name, comment, rating) VALUES ('$productId', '$reviewUser', '$reviewComment', '$reviewRating')";

        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }
}
