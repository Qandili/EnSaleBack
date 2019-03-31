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

<<<<<<< HEAD
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
=======
Route::get('/annonces', function () {
    return view('ads');
});

Route::get('/categories', function () {
    return view('categories');
});

>>>>>>> 26a697972957dc30d944f78725f27989e7f3d2c1
