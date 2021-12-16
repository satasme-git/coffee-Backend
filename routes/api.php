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
Route::post('/points/{id}', 'App\Http\Controllers\Auth\RegisterController@points');
Route::post('/countorder/{id}', 'App\Http\Controllers\Auth\RegisterController@count_dataorder');
Route::post('/countorderbox/{id}', 'App\Http\Controllers\Auth\RegisterController@count_dataorderbox');

Route::post('/fileUpload', 'App\Http\Controllers\Auth\RegisterController@fileUpload');




Route::post('/getslides', 'App\Http\Controllers\Admin\StyleController@getslides');
Route::post('/cart_data', 'App\Http\Controllers\OrderController@register');

// reset password


Route::put('/updatePassword/{id}', 'App\Http\Controllers\Auth\ForgotPasswordController@updatePassword');

Route::post('/resetPassword/{id}', 'App\Http\Controllers\Auth\ForgotPasswordController@resetPassword');

Route::post('/checkCode/{id}', 'App\Http\Controllers\Auth\ForgotPasswordController@checkCode');

// put user data
Route::put('/nameUpdate/{id}', 'App\Http\Controllers\Auth\RegisterController@nameUpdate');
Route::put('/phoneUpdate/{id}', 'App\Http\Controllers\Auth\RegisterController@phoneUpdate');

//order_box
Route::post('/cart_box_data', 'App\Http\Controllers\OrderBoxController@insertOrder');

Route::get('/order_history/{id}', 'App\Http\Controllers\OrderController@orderHistory');
Route::get('/order_box_history/{id}', 'App\Http\Controllers\OrderController@orderBoxHistory');


Route::get('/getopendetails', 'App\Http\Controllers\OrderController@getopendetails');
Route::get('/getweek', 'App\Http\Controllers\OrderController@getweek');
Route::get('/getweek2', 'App\Http\Controllers\OrderController@getweek2');

Route::post('/dailSteps', 'App\Http\Controllers\Auth\RegisterController@addStepsByUser');
// open dates
// Route::get('/getopendetails', 'App\Http\Controllers\OpenController@getopendetails');









