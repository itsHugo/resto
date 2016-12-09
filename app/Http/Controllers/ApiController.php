<?php

namespace App\Http\Controllers;

use App\Repositories\GeoRepository;
use App\Repositories\ReviewRepository;
use Auth;
use Illuminate\Http\Request;


/**
 * Class ApiController
 * @package App\Http\Controllers
 */
class ApiController extends Controller
{
    /**
     * @var GeoRepository|ReviewRepository
     */
    protected $geo, $reviews;

    /**
     * ApiController constructor.
     * @param GeoRepository $geo
     * @param ReviewRepository $reviews
     */
    public function __construct(GeoRepository $geo, ReviewRepository $reviews){
        $this->geo = $geo;
        $this->reviews = $reviews;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_restaurants(Request $request){
        $restaurants = $this->geo->getRestaurantsNear($request->latitude, $request->longitude);

        return response()->json($restaurants, 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_reviews(Request $request){
        $reviews = $this->reviews->forRestaurant($request->restaurant_id);

        return response()->json($reviews, 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store_restaurant(Request $request){
        $credentials = $request->only('email', 'password');
        $valid = Auth::once($credentials);

        if (!$valid)
            return response()->json(['error' => 'invalid_credentials'], 401);
        else{
            // Retrieve
            $pairs = $this->geo->getGeocodingSearchResults($request->postal_code);
            $latitude = $pairs['latitude'];
            $longitude = $pairs['longitude'];

            // Store in database
            $restaurant = $request->user()->restaurants()->create([
                'name' => $request->name,
                'street_address' => $request->street_address,
                'city' => $request->city,
                'province' => $request->province,
                'postal_code' => $request->postal_code,
                'genre' => $request->genre,
                'min_price' => $request->min_price,
                'max_price' => $request->max_price,
                'latitude' => $latitude,
                'longitude' => $longitude
            ]);

            return response()->json(['restaurant' => $restaurant], 200);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store_review(Request $request){
        $credentials = $request->only('email', 'password');
        $valid = Auth::once($credentials);

        if(!$valid)
            return response()->json(['error' => 'invalid_credentials'], 401);
        else {
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


            return response()->json(['review' => $review], 200);
        }
    }


}
