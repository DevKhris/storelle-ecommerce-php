<?php

namespace App\Models\Reviews;

use App\Alerts\Alerts;
use App\Core\Database;


/**
 * Class Review for adding reviews to db extending from BaseReview model
 *
 * @package RubyNight\App\Reviews;
 *
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */
final class Review
{
    /**
     * @var App\Core\Database database
     */
    private Database $db;

    /**
     * Constructor function
     *
     * @return $this
     */
    public function __construct()
    {
        $this->db = new Database;
        return $this;
    }

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

    /**
     * Get review from database by product id
     */
    /**
     * Get reviews from product by id
     *
     * @param int $id product id
     *
     * @return json reviews json
     */
    public function get($id, $json = true)
    {
        // save query to reviews array
        $reviews = $this->db->select('reviews', "productId = $id");
        // encode reviews array to json
        if ($json) {
            $json = json_encode($reviews);
            // Returns the reviews json
            return $json;
        }
        $result = $reviews;
        return $result;
    }
}