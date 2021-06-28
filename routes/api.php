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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/neworder', 'App\Http\Controllers\OrderController@newOrder');

Route::post('/testorder', 'App\Http\Controllers\OrderController@testOrder');

Route::post('/profile/{id}', 'App\Http\Controllers\Auth\RegisterController@profile');


Route::post('/getslides', 'App\Http\Controllers\Admin\StyleController@getslides');
Route::post('/cart_data', 'App\Http\Controllers\OrderController@register');

//order_box
Route::post('/cart_box_data', 'App\Http\Controllers\OrderBoxController@insertOrder');

Route::get('/order_history/{id}', 'App\Http\Controllers\OrderController@orderHistory');
Route::get('/order_box_history/{id}', 'App\Http\Controllers\OrderController@orderBoxHistory');