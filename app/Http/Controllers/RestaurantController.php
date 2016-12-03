<?php

namespace App\Http\Controllers;

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
     * Where to redirect users after adding.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('auth');
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

