<?php

namespace App\Controllers;

use App\Application;
use App\Core\Request;
use App\Reviews\Review;
use App\Reviews\Reviews;
use App\Reviews\addReview;
use App\Reviews\getReviews;

/**
 *
 */
class ReviewsController
{
     /**
     * [get reviews view]
     *
     * @return [view] [renders view]
     */
    public static function index()
    {
        // render view from router for reviews
        return Application::$app->router->renderView('reviews');
    }

    /**
     * [get reviews requests]
     *
     * @return [array] [response]
     */
    public static function get()
    {
        if (isset($_REQUEST['id'])) {
            // get id from requests
            $id = $_REQUEST['id'];
            $res = [];
            // get reviews and save to response var from id
            $res = Reviews::getReviews($id);
            // return response
            return $res;
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
            $reviewUserName = $_SESSION['name'];
            $reviewFeedBack = $review['feedBack'];
            $reviewRating = $review['rating'];
            // add review to db call
            Review::addReview($productId, $reviewUserName, $reviewFeedBack, $reviewRating);
        }
    }
}
