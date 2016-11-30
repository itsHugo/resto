<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\Http\Request;

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_id' => 'required',
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'min_price' => '',
            'max_price' => '',
            'latitude' => '',
            'longitude' => '',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Restaurant
     */
    protected function create(array $data)
    {
        return Restaurant::create([
            'user_id' => $data['user_id'],
            'name' => $data['name'],
            'address' => $data['address'],
            'min_price' => $data['min_price'],
            'max_price' => $data['max_price'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
        ]);
    }
    
    
    // Denys
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
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
