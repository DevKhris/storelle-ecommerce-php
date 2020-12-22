<?php

namespace App\Reviews;

use App\Model\BaseReview;

/**
 * Class Review for adding reviews to db extending from BaseReview model
 * 
 * @package RubyNight\App\Reviews;
 * 
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */

class Review extends BaseReview
{

    /**
     * Add review to the database
     *
     * @param int $productId
     * @param string $userName
     * @param string $feedBack
     * @param int $rating
     */
    public function add($productId, $userName, $feedBack, $rating)
    {
        global $conn;
        // Query to insert values from review into db
        $sql = "INSERT INTO reviews (productId, userName, feedBack, rating) VALUES (:productId, :userName, :feedBack, :rating)";
        // prepare query
        $stmt = $conn->prepare($sql);

        // do the query and store the result
        $result = $stmt->execute([':productId': => $productId, ':userName': => $userName]);
        // checks if result has value
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
    }
}