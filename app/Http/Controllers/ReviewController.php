<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function destroy(Request $request, Review $review)
    {
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
    public function edit(Request $request, Review $review)
    {
        $this->authorize('edit', $review);

        // Edit restaurant

        // Redirect
    }

    public function store(Request $request)
    {
        // Validate request data
        $this->validate($request, [
            'restaurant_id' => 'required',
            'title' => 'required|max:255',
            'rating' => 'required|max:255',
            'content' => 'required|max:255'
        ]);

        // Store in database
        $review = $request->user()->reviews()->create([
            'restaurant_id' => $request->restaurant_id,
            'title' => $request->title,
            'content' => $request->content,
            'rating' => $request->rating,
        ]);

        $reviews = DB::table('reviews')->where('restaurant_id', '=', $request->restaurant_id)->
        paginate(20);

        return redirect('/restaurant/'.$review->restaurant_id, ['reviews' => $reviews]);
    }
}