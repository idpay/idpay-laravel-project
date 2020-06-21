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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/{id?}', 'ActivityController@show')->name('show');
Route::POST('activity/store', 'ActivityController@store')->name('store');
Route::get('redirect/{url}/{id}', 'ActivityController@redirect')->name('redirect');
Route::POST('callback', 'ActivityController@callback')->name('callback');
Route::post('verify', 'ActivityController@verify')->name('verify');
Route::post('store_callback', 'ActivityController@store_callback')->name('store_callback');
