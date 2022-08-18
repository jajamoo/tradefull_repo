<?php

use Illuminate\Support\Facades\Route;

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

Route::get('show-orders', 'App\Http\Controllers\WebController@showOrders');
Route::post('add-order', 'App\Http\Controllers\WebController@addOrder');
Route::post('delete-order', 'App\Http\Controllers\WebController@deleteOrder');
Route::post('update-order', 'App\Http\Controllers\WebController@updateOrder');

