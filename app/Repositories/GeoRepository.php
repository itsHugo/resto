<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 2016-12-02
 * Time: 6:31 PM
 */

namespace App\Repositories;

use DB;
use App\Restaurant;

/**
 * Class GeoRepository
 * @package App\Repositories
 */
class GeoRepository
{
    /**
     * Takes in an address and retrieves its latitude and longitude from
     * the Google Maps' API.
     *
     * Code snippet credited to Jaya Nilakantan.
     * @param $address
     * @return mixed
     */
    public function getGeocodingSearchResults($address) {
        $address = urlencode($address); //Url encode since it was provided by user
        $url = "http://maps.google.com/maps/api/geocode/xml?address={$address}&sensor=false";

        // Retrieve the XML file
        $results = file_get_contents($url);
        $xml = new \DOMDocument();//backslash to indicate global namespace
        $xml->loadXML($results);

        $response_status = $xml->getElementsByTagName('status')->item(0)->nodeValue;

        // Gets the latitude and longitude if there is a valid location
        if($response_status === "OK") {
            $latitude = $xml->getElementsByTagName('lat')->item(0)->nodeValue;
            $longitude = $xml->getElementsByTagName('lng')->item(0)->nodeValue;

            // assign pairs to array
            $pairs['latitude'] = $latitude;
            $pairs['longitude'] = $longitude;
        } else {
            $pairs['response'] = $response_status;
        }
        return $pairs;
    }

    /**
     * Retrieves all the restaurants near the latitude/longitude pairs within a certain radius.
     *
     * Code snippet credited to Jaya Nilakantan.
     * @param $latitude
     * @param $longitude
     * @param int $radius
     * @return mixed
     */
    public function getRestaurantsNear($latitude, $longitude, $radius = 50){

        $distances = Restaurant::select('restaurants.*')
            ->selectRaw('( 6371 * acos( cos( radians(?) ) *
            cos( radians( latitude ) )
            * cos( radians( longitude ) - radians(?))
            + sin( radians(?) ) *
            sin( radians(latitude ) ) )
          ) AS distance', [$latitude, $longitude, $latitude]);

        $restaurants = DB::table( DB::raw("({$distances->toSql()}) as restodistance") )
            ->mergeBindings($distances->getQuery())
            ->whereRaw("distance < ? ", [$radius])
            ->orderBy('distance')
            ->get();

        return $restaurants;
    }

}