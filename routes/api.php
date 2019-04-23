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

// Route::get('students',"StudentController@index");

// Route::get('students/{student_cne}',"StudentController@show");

Route::resource('students', 'StudentController');

// Route::post('login', 'LoginController@login');

Route::view('/test', 'test');


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
Auth::routes();
    Route::group([
        'prefix' => 'auth'
    ], function () {
        Route::post('login', 'AuthController@login');
        Route::post('signup', 'AuthController@signup');
        Route::group([
            'middleware' => 'auth:api'
        ], function() {
            Route::get('ads','AdController@index');
            Route::get('logout', 'AuthController@logout');
            Route::get('user', 'AuthController@user');
        });
    });