<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\Repositories\GeoRepository;

class HomeController extends Controller
{
    protected $geo;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(GeoRepository $geo)
    {
        $this->middleware('guest');

        $this->geo = $geo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$restaurants =  $this->geo->getRestaurantsNear($request->latitude, $request->longitude)-> paginate(20);
        //$restaurants = Restaurant::orderBy('name' , 'ASC') -> paginate(20);
        //return view('home', [
        //    'restaurants' => $restaurants,
        //]);
        return view('home');
    }
}
