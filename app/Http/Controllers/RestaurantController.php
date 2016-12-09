<?php

namespace App\Http\Controllers;

use App\Repositories\GeoRepository;
use App\Repositories\ReviewRepository;
use App\Restaurant;
use App\Review;
use Illuminate\Http\Request;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class RestaurantController
 * @package App\Http\Controllers
 */
class RestaurantController extends Controller
{
    /**
     * @var GeoRepository|ReviewRepository
     */
    protected $geo, $reviews;

    /**
     * RestaurantController constructor.
     * @param GeoRepository $geo
     * @param ReviewRepository $reviews
     */
    public function __construct(GeoRepository $geo, ReviewRepository $reviews){
        $this->geo = $geo;
        $this->reviews = $reviews;
    }

    /**
     * Displays a view with a restaurant's details.
     *
     * @param Request $request
     * @param Restaurant $restaurant
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, Restaurant $restaurant){

        $reviews = $this->reviews->forRestaurant($restaurant)->paginate(5);

        return view('restaurants.index', [
            'restaurant' => $restaurant,
            'reviews' => $reviews // Get reviews
        ]);
    }

    /**
     * Creates a new restaurant.
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
            'min_price' => 'required|numeric',
            'max_price' => 'required|numeric',
        ]);

        // Retrieve the latitude and longitude
        $pairs = $this->geo->getGeocodingSearchResults($request->postal_code);

        // If the location is invalid, redirect to the form again.
        if(isset($pairs['response']) && $pairs['response'] != "OK") {
            return view('/restaurants/add')->withErrors("This restaurant's location is invalid");
        } else {
            // Creates a restaurant in the database.

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
            // Redirects to the new restaurant's page
            return redirect('/restaurant/'.$restaurant->id);
        }
    }


    /**
     * NOT USED AT THE MOMENT
     * @param Request $request
     * @param Restaurant $restaurant
     */
    public function edit(Request $request, Restaurant $restaurant){
        $this->authorize('edit', $restaurant);
    }

    /**
     * Edits a restaurants'
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function editResto(Request $request){
        // Validate request data
        $this->validate($request, [
            'name' => 'required|max:255',
            'street_address' => 'required|max:255',
            'city' => 'required|max:255',
            'province' => 'required|max:255',
            'postal_code' => 'required|min:6|max:7',
            'genre' => 'required',
            'min_price' => 'required|numeric',
            'max_price' => 'required|numeric',
        ]);

        DB::table('restaurants')->where('id', '=', $request -> id) -> update([
            'name' => $request -> name,
            'city' => $request -> city,
            'street_address' => $request -> street_address,
            'province' => $request -> province,
            'postal_code' => $request -> postal_code,
            'genre' => $request -> genre,
            'min_price' => $request -> min_price,
            'max_price' => $request -> max_price]);

        return redirect('/restaurant/'.$request->id);
    }

    /**
     * Deletes a restaurant from the database.
     *
     * @param Request $request
     * @param Restaurant $restaurant
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function deleteResto(Request $request, Restaurant $restaurant){
        
        DB::table('reviews')->where('restaurant_id', '=', $restaurant->id) -> delete();
        DB::table('restaurants')->where('id', '=', $restaurant->id) -> delete();
        return redirect('/');
    }

    /**
     * Returns the restaurants that matches the search query.
     *
     * @param Request $req
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function results(Request $req){
        $keywords = $req -> input('keywords');
        // TO DO: add where for city name, genre, address,...
        $restos = Restaurant::where('name', 'ilike', '%'.$keywords.'%') ->
            orWhere('genre', 'ilike', '%'.$keywords.'%') ->
            orWhere('city', 'ilike', '%'.$keywords.'%') ->
            paginate(20);

        return view('results', [
            'restaurants' => $restos,
            'keywords' => $keywords
        ]);
    }

}

