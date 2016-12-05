<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\GeoRepository;

class GeoController extends Controller
{
    protected $geo;

    /**
     * GeoController constructor.
     * Sets the GeoRepository.
     *
     * @param GeoRepository $geo
     */
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

            // Sets the pairs to session variables
            session(['latitude' => $pairs['latitude']]);
            session(['longitude' => $pairs['longitude']]);


            return redirect()->action('HomeController@index', [
                'latitude' =>$pairs['latitude'],
                'longitude' => $pairs['longitude']
            ]);


        //return redirect()->route('/restaurants', [$pairs];

    }
}
