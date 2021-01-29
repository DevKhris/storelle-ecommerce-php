<?php

namespace App\Controllers;

use App\Application;
use App\Core\Request;
use App\Models\Reviews\Review;
use App\Models\Reviews\Reviews;

/**
 *
 */
class ReviewsController
{
    /**
     * Index function
     *
     * @return view render view
     */
    public static function index()
    {
        // render view from router for reviews
        return Application::$app->router->view('reviews');
    }

    /**
     * Get reviews from product by Id
     *
     * @return array response
     */
    public static function get()
    {
        if (isset($_REQUEST['id'])) {
            // get id from requests
            $id = $_REQUEST['id'];
            // get reviews and save to response var from id
            $reviews = new Reviews();
            // return response
            return $reviews->get($id);
        }
    }

    /**
     * [review add requests handler]
     *
     * @return [type] [description]
     */
    public static function add()
    {
        if (isset($_REQUEST['review'])) {
            // decode json from request
            $review = json_decode($_REQUEST['review'], true);
            // set values from array keys
            $productId = $review['productId'];
            // assign name from current user in session
            $username = $_SESSION['username'];
            $feedback = $review['feedback'];
            $rating = $review['rating'];
            // add review to db call
            Review::addReview($productId, $username, $feedback, $rating);
        }
    }
}
