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

Route::get('/{order}', 'ActivityController@show')->name('show');
Route::get('/', 'ActivityController@index')->name('index');
Route::post('activity/store', 'ActivityController@store')->name('store');
Route::post('activity/payment/{id}', 'ActivityController@payment')->name('payment');
Route::post('callback', 'ActivityController@callback')->name('callback');
Route::post('verify/{id}', 'ActivityController@verify')->name('verify');

