<?php

namespace App\Http\Controllers;

use App\Repositories\GeoRepository;
use App\Repositories\ReviewRepository;
use App\Restaurant;
use Illuminate\Http\Request;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RestaurantController extends Controller
{
    /**
     * Repositories variable.
     */
    protected $geo, $reviews;

    public function __construct(GeoRepository $geo, ReviewRepository $reviews){
        $this->geo = $geo;
        $this->reviews = $reviews;
    }

    public function index(Request $request, Restaurant $restaurant){

        $reviews = DB::table('reviews')->where('restaurant_id', '=', $restaurant->id)->
        paginate(5);

        return view('restaurants.index', [
            'restaurant' => $restaurant,
            'reviews' => $reviews // Get reviews
        ]);
    }

    /**
     * Create a new restaurant.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // Validate request data
        $this->validate($request, [
            'name' => 'required|max:255',
            'street_address' => 'required|max:255',
            'city' => 'required|max:255',
            'province' => 'required|max:255',
            'postal_code' => 'required|min:6|max:7',
            'genre' => 'required',
            'min_price' => 'required',
            'max_price' => 'required',
        ]);

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

        return redirect('/restaurant/'.$restaurant->id);
    }



    public function edit(Request $request, Restaurant $restaurant){
        $this->authorize('edit', $restaurant);

        // Edit restaurant
        $restaurant->name = $request->name;

    }

    public function editResto(Request $request){
        $restos = DB::table('restaurants')->where('name', '=', $request -> name) -> update(['city' => $request -> city,
            'street_address' => $request -> street_address,
            'province' => $request -> province,
            'postal_code' => $request -> postal_code,
            'genre' => $request -> genre,
            'min_price' => $request -> min_price,
            'max_price' => $request -> max_price]);

        return redirect('/restaurant/');
    }

    protected function results(Request $req){
        $keywords = $req -> input('keywords');
        // TO DO: add where for city name, genre, address,...
        $restos = DB::table('restaurants')->where('name', 'like', '%'.$keywords.'%') ->
            orWhere('genre', 'like', '%'.$keywords.'%') ->
            orWhere('city', 'like', '%'.$keywords.'%') ->
            paginate(20);

        return view('results', [
            'restaurants' => $restos,
            'keywords' => $keywords
        ]);
    }

}

