<?php

namespace App\Model\Reviews;

use App\Interfaces\ReviewInterface;
use App\Core\Database;

/**
 * Class Review for adding reviews to db extending from BaseReview model
 *
 * @package RubyNight\App\Reviews;
 *
 * @author Christian Hernandez (@DevKhris) <devkhris@outlook.com>
 */
final class Review implements ReviewInterface
{
    public $reviewId;
    public $productId;
    public $username;
    public $rating;
    public $feedback;

    /**
     * @var App\Core\Database database
     */
    private Database $db;

    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->reviewId = $reviewId;
        $this->productId = $productId;
        $this->username = $username;
        $this->rating = $rating;
        $this->feedback = $feedback;
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
     */
    public function add($productId, $username, $feedback, $rating)
    {
        // Query to insert values from review into db and store the result
        $result = $this->db->insert('reviews', '(productId, username, feedback, rating)', "$productId, $username, $feedback, $rating");
         // checks if result has value
        if (!$result) {
            echo Alerts::review_submit_error();
        }
        echo Alerts::review_submit_success();
    }
}
