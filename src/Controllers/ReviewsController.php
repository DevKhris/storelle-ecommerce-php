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
        if (!isset($_REQUEST['id'])) {
            throw new RuntimeException('Can\' find request');
        }
        // get id from requests
        $id = $_REQUEST['id'];
        // get reviews and save to response var from id
        $reviews = new Reviews();
        // return response
        return $reviews->get($id);
    }

    /**
     * Add review action
     *
     * @return void
     */
    public static function add()
    {
        if (!isset($_REQUEST['review'])) {
            throw new RuntimeException('Can\'t find request');
        }

        // decode json from request
        $data = json_decode($_REQUEST['review'], true);
        
        // assign vars values
        $productId = $data['productId'];
        $username = $_SESSION['username'];
        $feedback = $data['feedback'];
        $rating = $data['rating'];

        // add review to db call
        $review = new Review();
        $review->add($productId, $username, $feedback, $rating);
    }
}
