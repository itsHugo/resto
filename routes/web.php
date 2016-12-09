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

// Redirect for when a guest tries to add, then login
// Put as a function in restaurant controller later
//Route::get('/home', function(){
//    return redirect()->action('HomeController@index', [
//        'latitude' => session('latitude'),
//        'longitude' => session('longitude')
//    ]);
//});


Route::get('/home', 'HomeController@index');
Route::post('/geo', 'GeoController@index');
Route::get('/restaurant/{restaurant}', 'RestaurantController@index');

Route::get('/restaurant', function(){
    return view('/restaurants/add');
})->middleware('auth');
Route::post('/restaurant', 'RestaurantController@store')->middleware('auth');

Route::post('/editResto', 'RestaurantController@editResto');
Route::post('/deleteResto', 'RestaurantController@deleteResto');
Route::delete('/restaurant/{restaurant}', 'RestaurantController@deleteResto');

Route::get('/restaurants', 'RestaurantController@index');
Route::get('/results', 'RestaurantController@results');

Route::post('/review/store', 'ReviewController@store');
Route::post('/editReview', 'ReviewController@editReview');
Route::delete('/review/{review}', 'ReviewController@deleteReview');