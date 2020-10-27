<?php

Route::get('callback', 'ActivityController@callback');
Route::post('callback', 'ActivityController@callback')->name('callback');
Route::get('/', 'ActivityViewController@index')->name('index');
Route::get('/{order}', 'ActivityViewController@show')->name('show');
Route::post('activity/store', 'ActivityController@store')->name('store');
Route::post('activity/payment/{id}', 'ActivityController@payment')->name('payment');
Route::post('verify/{id}', 'ActivityController@verify')->name('verify');

