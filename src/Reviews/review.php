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
     * 
     * @param [string] $reviewFeedBack
     * 
     * @param [int] $reviewRating
     * 
     * @return void
     */

    public static function addReview($productId, $reviewUserName, $reviewFeedBack, $reviewRating)
    {
        global $conn;

        $sql = "INSERT INTO reviews (productId, userName, feedBack, rating) VALUES ('$productId', '$reviewUserName', '$reviewFeedBack', '$reviewRating')";

        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Warning, Can\'t submit review.</strong>
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
              </div>';
        } else {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Review submited.</strong>
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
              </div>';
        }

        return $result;
        return $_SESSION;
    }
}
