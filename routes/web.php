<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ActivityViewController;

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

Route::get('callback', [ActivityController::class, 'callback']);
Route::post('callback', [ActivityController::class, 'callback'])->name('callback');
Route::get('/', [ActivityViewController::class, 'index'])->name('index');
Route::get('/{order}', [ActivityViewController::class, 'show'])->name('show');
Route::post('activity/store', [ActivityController::class, 'store'])->name('store');
Route::post('activity/payment/{id}', [ActivityController::class, 'payment'])->name('payment');
Route::post('verify/{id}', [ActivityController::class, 'verify'])->name('verify');
