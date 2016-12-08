<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('/apiv1/restaurant', 'ApiController@store_restaurant');
Route::post('/apiv1/review', 'ApiController@store_review');
Route::get('/apiv1/restaurants', 'ApiController@get_restaurants');
Route::get('/apiv1/reviews', 'ApiController@get_reviews');


