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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Ads
    //List ads
    Route::get('ads','AdController@index');
    //List single ad
    Route::get('ad/{id}','AdController@show');
    //Create new ad
    Route::post('ad','AdController@store');
    //Update ad
    Route::put('ad','AdController@store');
    //Delete ad
    Route::delete('ad/{id}','AdController@destroy');
//Categories
    //List categories
    Route::get('categories','CategorieController@index');
