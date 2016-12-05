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
        return view('restaurants.index', [
            'restaurant' => $restaurant,
            'reviews' => $this->reviews->forRestaurant($restaurant) // Get reviews
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
        /*
        'name' => $faker->company,
       'street_address' => $faker->streetAddress,
       'city' => $faker->city,
       'province' => $faker->countryCode,
       'postal_code' => $faker->postcode,
       'genre' => $faker->word,
       'min_price' => $faker->numberBetween(2,10),
       'max_price' => $faker->numberBetween(20,50),
        */
        // Validate request data
        $this->validate($request, [
            'user_id' => 'required',
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'genre' => 'required|max:255',
            'min_price' => 'required',
            'max_price' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        // Store in database
        $request->user()->restaurants()->create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'street_address' => $request->street_address,
            'city' => $request->city,
            'genre' => $request->genre,
            'min_price' => $request->min_price,
            'max_price' => $request->max_price,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect('/restaurants/{restaurant}');
    }

    public function edit(Request $request, Restaurant $restaurant){
        $this->authorize('edit', $restaurant);

        // Edit restaurant
        $restaurant->name = $request->name;

    }
    
    
    // Denys
    //use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function contact(){
        return view('search');
    }
    
    protected function results(Request $req){
        $keywords = $req -> input('keywords');
        // TO DO: add where for city name, genre, address,...
        $restos = DB::table('restaurants')->where('name', 'like', '%'.$keywords.'%')->paginate(20);

        return view('results', [
            'restaurants' => $restos,
            'keywords' => $keywords
        ]);
    }

}

