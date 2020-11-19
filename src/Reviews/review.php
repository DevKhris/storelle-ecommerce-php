<?php
/**
 * Class Review for adding reviews to db extending from BaseReview model
 * 
 * @package RubyNight\App\Reviews;
 * 
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */
namespace App\Reviews;

use App\Model\BaseReview;

class Review extends BaseReview
{

    /**
     * addReview to add review to the database
     *
     * @param [int] $productId
     * 
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
        // Query to insert values from review into db
        $sql = "INSERT INTO reviews (productId, userName, feedBack, rating) VALUES ('$productId', '$reviewUserName', '$reviewFeedBack', '$reviewRating')";

        // do the quert and store the result
        $result = mysqli_query($conn, $sql);
        // checks if result is true
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

        // returns result and session var (deprecated)
        return $result;
        return $_SESSION;
    }
}
