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






Route::get('/', 'ActivityController@index')->name('index');
Route::get('/{id?}', 'ActivityController@show')->name('show');
Route::post('activity/store', 'ActivityController@store')->name('store');
Route::post('activity/payment/{id}', 'ActivityController@payment')->name('payment');
Route::post('callback', 'ActivityController@callback')->name('callback');
Route::post('verify/{id}', 'ActivityController@verify')->name('verify');



//Route::get('redirect/{url}/{id}', 'ActivityController@redirect')->name('redirect');

//Route::post('store_callback', 'ActivityController@store_callback')->name('store_callback');
