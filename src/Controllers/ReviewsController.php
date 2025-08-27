<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Services\ReviewService;
use Psr\Http\Message\ServerRequestInterface;

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
    public function store(ReviewService $reviewService, ServerRequestInterface $request)
    {
        $data = $request->getParsedBody();
        $review = $reviewService->store($data);
    }
}