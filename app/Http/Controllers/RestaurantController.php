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
        $restos = DB::table('restaurants')->where('name', 'like', '%'.$keywords.'%')->paginate(20);

        return view('results', [
            'restaurants' => $restos,
            'keywords' => $keywords
        ]);
    }

}

