<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportAuthController;

use \App\Http\Controllers\Api\BookingController;

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

// Only used during development to test API using postman/curl
Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);

Route::prefix('/bookings')->namespace('App\Http\Controllers\Api')->name('bookings.')->group(function () {

    // available for guest and logged-in users
    Route::get('', [BookingController::class, 'index'])->name('index');
    Route::get('{id}', [BookingController::class, 'show'])->name('show');

    // available logged-in users only
    Route::middleware('auth:api')->group(function () {
        Route::post('store', [BookingController::class, 'store'])->name('store');
        Route::put('{id}', [BookingController::class, 'update'])->name('update');
        Route::delete('{id}', [BookingController::class, 'destroy'])->name('destroy');
    });
});