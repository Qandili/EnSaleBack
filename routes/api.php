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


Auth::routes();
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('signup', 'Auth\LoginController@signup');
    Route::group(['middleware' => 'auth:api'], function() {
        //*******************Ads
        //List ads
        Route::get('ads','AdController@index');
        //List single ad
        Route::get('ad/{id}','AdController@show');
        //Post new ad
        Route::post('ad/new','AdController@store');
        //Update ad
        Route::put('ad','AdController@store');
        //Delete ad
        Route::delete('ad/{id}','AdController@destroy');
        //*******************Categories
        //List categories
        Route::get('categories','CategorieController@index');
        Route::get('ads','AdController@index');
        Route::get('profile','ProfileController@index');
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});