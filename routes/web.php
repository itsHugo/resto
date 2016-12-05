<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::post('/geo', 'GeoController@index');

Route::get('/restaurants', 'RestaurantController@index');

Route::get('/restaurant/{restaurant}', 'RestaurantController@index');

Route::get('/results', 'RestaurantController@results');