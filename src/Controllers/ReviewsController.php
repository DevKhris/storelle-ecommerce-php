<?php

namespace App\Controllers;

use App\Application;
use App\Core\Request;
use App\Core\Controller;
use App\Models\Reviews\Review;


/**
 *
 */
class ReviewsController extends Controller
{
    /**
     * Add review action
     *
     * @return void
     */
    public function store($id)
    {
        if (!isset($_REQUEST['review'])) {
            throw new \PDOException('Can\'t find request');
        }

        // decode json from request
        $data = json_decode($_REQUEST['review'], true);

        // assign vars values
        $id = $data['id'];
        $username = $_SESSION['username'];
        $feedback = $data['feedback'];
        $rating = $data['rating'];
        // add review to db call
        $review = new Review();
        $review->add($id, $username, $feedback, $rating);
    }
}