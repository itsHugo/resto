<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Destroy a given review.
     *
     * @param Request $request
     * @param Review $review
     */
    public function destroy(Request $request, Review $review){
        $this->authorize('destroy', $review);

        $review->delete();

        // Redirect
    }

    /**
     * Edit a given review
     *
     * @param Request $request
     * @param Review $review
     */
    public function edit(Request $request, Review $review){
        $this->authorize('edit', $review);

        // Edit restaurant

        // Redirect
    }

}
