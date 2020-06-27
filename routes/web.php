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

use App\Order;
use GuzzleHttp\Client;

//Route::get('/', function () {
//
//
//
//
//
//
////    dd($activity);
//
//
//
//
//    $params = [
//        'API_KEY' => '53053025-a5b6-4926-aa74-427b95c285d4 ',
//        'sandbox' => '1',
//        'name' => 'mohammad',
//        'phone_number' => '09361446385',
//        'email' => 'mohammad@gmail.com',
//        'amount' => '3000',
//        'reseller' => '30000',
//        'status' => '30000',
//
//    ];
//
//
//    $params['callback']='http://127.0.0.1:8000/callback';
//    $params['desc']='توضیحات پرداخت کننده';
//    $params['order_id']='1';
//
//
//    $header = [
//        'Content-Type' => 'application/json',
//        "X-API-KEY" => $params['API_KEY'],
//        'X-SANDBOX' => $params['sandbox']
//    ];
//
//    $client = new Client();
//    $res = $client->request('POST','https://api.idpay.ir/v1.1/payment',
//        [
//            'json' => $params,
//            'headers' => $header,
//            'http_errors' => false
//        ]);
//
//
//
//    $response = json_decode($res->getBody());
//
//
//    dd($response);
//
//
//
//
//    $order = Order::create($params);
//
//    $order->save();
//
//
////    dd($order->toArray());
//    return view('welcome');
//});


Route::get('/', 'ActivityController@index')->name('index');


Route::get('/{id?}', 'ActivityController@show')->name('show');


Route::post('activity/store', 'ActivityController@store')->name('store');


Route::post('activity/payment/{id}', 'ActivityController@payment')->name('payment');


Route::get('redirect/{url}/{id}', 'ActivityController@redirect')->name('redirect');
Route::POST('callback', 'ActivityController@callback')->name('callback');

Route::post('verify/{id}', 'ActivityController@verify')->name('verify');




Route::post('store_callback', 'ActivityController@store_callback')->name('store_callback');
