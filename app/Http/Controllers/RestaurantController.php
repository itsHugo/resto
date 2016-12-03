<?php

namespace App\Http\Controllers;

use App\Repositories\GeoRepository;
use App\Restaurant;
use Illuminate\Http\Request;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class RestaurantController extends Controller
{
    protected $geo;

    public function __construct(GeoRepository $geo){
        $this->geo = $geo;
    }

    public function index(Request $request){
        //$restaurants = Restaurant::orderBy('created_at', 'DESC') -> paginate(10);
        $restaurants = $this->geo->getRestaurantsNear(45.4617295, -73.5938763, 20);

        return view('home', [
            'restaurants' => $restaurants
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
            'address' => $request->address,
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
    }
    
    
    // Denys
    //use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function contact(){
        return view('search');
    }
    
    protected function results(Request $req){
        $keywords = $req -> input('keywords');
        $restos = DB::table('restaurants')
                -> select('name') -> pluck('name');
        $imploded = explode("','", $restos);
        return view('results') -> with('keywords', $keywords)
                -> with('restos', $restos);
    }

}

