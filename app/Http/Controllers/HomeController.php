<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\Repositories\GeoRepository;

class HomeController extends Controller
{
    /**
     * @var GeoRepository
     */
    protected $geo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(GeoRepository $geo)
    {
        $this->geo = $geo;
    }

    /**
     * Show home page with nearest restaurants.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $restaurants = $this->geo->getRestaurantsNear($request->latitude, $request->longitude);

        return view('/home', [
            'restaurants' => $restaurants
        ]);
    }
}
