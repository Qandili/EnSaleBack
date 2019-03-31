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
<<<<<<< HEAD

// Route::get('students',"StudentController@index");

// Route::get('students/{student_cne}',"StudentController@show");

Route::resource('students', 'StudentController');

Route::post('login', 'LoginController@login');

Route::view('/test', 'test');


=======
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
>>>>>>> 26a697972957dc30d944f78725f27989e7f3d2c1
