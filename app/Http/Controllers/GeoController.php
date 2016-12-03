<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\GeoRepository;

class GeoController extends Controller
{
    /**
     * Where to redirect users after processing the form.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    protected $geo;

    public function __construct(GeoRepository $geo)
    {
        $this->geo = $geo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //if($request->error === 0){
            if($request->latitude && $request->longitude){
                $pairs['latitude'] = $request->latitude;
                $pairs['longitude'] = $request->longitude;
            } else {
                $pairs = $this->geo->getGeocodingSearchResults($request->postal);
            }
            return redirect('/restaurants', [
                'pairs' => $pairs
            ]);


        //return redirect('/restaurants');

    }
}
