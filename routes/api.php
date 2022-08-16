<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware(['throttle:api'])->group(function () {
    Route::group(['prefix' => 'mfa'], function() {
        Route::get('/getPrints', 'App\Http\Controllers\ApiController@getPrints');
    });

    Route::group(['prefix' => 'dj'], function() {
        Route::get('/getShirts', 'App\Http\Controllers\ApiController@getShirts');
    });
});

