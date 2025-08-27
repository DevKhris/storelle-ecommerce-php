<?php

namespace App\Models\Reviews;

use App\Alerts\Alerts;

final class Review
{
    /**
     * Add review to the database
     *
     * @param int    $id
     * @param string $username
     * @param string $feedback
     * @param int    $rating
     *
     * @return string
     */
    public function add($id, $username, $feedback, $rating)
    {
        // Query to insert values from review into db and store the result
        $result = $this->db->insert('reviews', 'productId, username, feedback, rating', "$id, '$username', '$feedback', $rating");

        // checks if result has value
        if (!$result) {
            echo Alerts::review_submit_error();
        } else {
            echo Alerts::review_submit_success();
        }
    }
}