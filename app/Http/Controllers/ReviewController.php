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
            'content' => 'required|max:255',
        ]);

        // Store in database
        $review = $request->user()->reviews()->create([
            'restaurant_id' => $request->restaurant_id,
            'title' => $request->title,
            'content' => $request->content,
            'rating' => $request->rating,
        ]);
        

        return redirect('/restaurant/'.$review->restaurant_id);
    }
    
     public function editReview(Request $request){
         
        $title = "title_edit".$request->id;
        $rating = "rating_edit".$request->id;
        $content = "content_edit".$request->id;
        
        DB::table('reviews')->where('id', '=', $request -> id) -> update([
            'title' => $request -> $title,
            'rating' => $request -> $rating,
            'content' => $request -> $content]); 

        return redirect('/restaurant/'.$request->restaurant_id);
    }
    
    public function deleteReview(Request $request){
         
        DB::table('reviews')->where('id', '=', $request -> review_id) -> delete();
        return redirect('/restaurant/'.$request->restaurant_id);
    }
}