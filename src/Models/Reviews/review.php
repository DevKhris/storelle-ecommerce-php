<?php

namespace App\Models\Reviews;

use App\Alerts\Alerts;
use App\Core\Database;
use App\Interfaces\ReviewInterface;

/**
 * Class Review for adding reviews to db extending from BaseReview model
 *
 * @package RubyNight\App\Reviews;
 *
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */
final class Review implements ReviewInterface
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
     * @param int    $productId
     * @param string $username
     * @param string $feedback
     * @param int    $rating
     *
     * @return string
     */
    public function add($productId, $username, $feedback, $rating)
    {
        // Query to insert values from review into db and store the result
        $result = $this->db->insert('reviews', 'productId, username, feedback, rating', "$productId, '$username', '$feedback', $rating");
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
    public function get($productId)
    {
        // To implement
    }
}
