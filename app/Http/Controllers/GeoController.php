<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\GeoRepository;

/**
 * Class GeoController
 * @package App\Http\Controllers
 */
class GeoController extends Controller
{
    /**
     * @var GeoRepository
     */
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
     * Retrieves a user's request, which is a postal code search, redirects to the
     * home page with the latitude and longitude from the postal code and displays
     * the nearest restaurants.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->latitude  && $request->longitude) {
            $pairs['latitude'] = $request->latitude;
            $pairs['longitude'] = $request->longitude;
        } else if($request->postal){
            $pairs = $this->geo->getGeocodingSearchResults($request->postal);
        }

        // If the location is not valid, returns the welcome page.
        if(isset($pairs['response']) && $pairs['response'] != "OK") {
            return view('welcome');
        } else {
            // Sets the pairs to session variables.
            session(['latitude' => $pairs['latitude']]);
            session(['longitude' => $pairs['longitude']]);
            // Redirects to home page with nearest restaurants.
            return redirect()->action('HomeController@index', [
                'latitude' => $pairs['latitude'],
                'longitude' => $pairs['longitude']
            ]);
        }



    }
}
