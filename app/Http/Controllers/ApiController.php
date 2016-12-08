<?php

namespace App\Http\Controllers;

use App\Repositories\GeoRepository;
use App\Repositories\ReviewRepository;
use Auth;
use Illuminate\Http\Request;


class ApiController extends Controller
{
    //
    protected $geo, $reviews;

    public function __construct(GeoRepository $geo, ReviewRepository $reviews){
        $this->geo = $geo;
        $this->reviews = $reviews;
    }

    public function get_restaurants(Request $request){
        $restaurants = $this->geo->getRestaurantsNear($request->latitude, $request->longitude);

        return response()->json($restaurants, 200);
    }

    public function get_reviews(Request $request){
        $reviews = $this->reviews->forRestaurant($request->restaurant_id);

        return response()->json($reviews, 200);
    }

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

    public function store_review(Request $request){

    }


}
