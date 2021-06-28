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

Route::get('/', function () {return view('welcome');});


//admin login
Route::get('/admin', 'Admin\LoginController@index');

// dashboard
Route::get('/admin/dashboard', 'Admin\DashboardController@index');

//customers
Route::get('/admin/addcustomers/{id}', 'App\Http\Controllers\Admin\CustomerController@addCustomers');
Route::get('/admin/customers', 'App\Http\Controllers\Admin\CustomerController@Customers');
Route::post('/admin/customers', 'App\Http\Controllers\Admin\CustomerController@saveCustomers');
Route::get('/admin/deletecustomers/{id}', 'App\Http\Controllers\Admin\CustomerController@deleteCustomers');

//foods
Route::get('/admin/addfood/{id}', 'App\Http\Controllers\Admin\CoffeeController@addFood');
Route::get('/admin/food', 'App\Http\Controllers\Admin\CoffeeController@Food');
Route::post('/admin/food', 'App\Http\Controllers\Admin\CoffeeController@saveFood');
Route::get('/admin/deletefood/{id}', 'App\Http\Controllers\Admin\CoffeeController@deleteFood');

//category
Route::get('/admin/addcategory/{id}', 'App\Http\Controllers\Admin\CoffeeController@addCategory');
Route::get('/admin/category', 'App\Http\Controllers\Admin\CoffeeController@category');
Route::post('/admin/category', 'App\Http\Controllers\Admin\CoffeeController@saveCategory');
Route::get('/admin/deletecategory/{id}', 'App\Http\Controllers\Admin\CoffeeController@deleteCategory');

//subcategory
Route::get('/admin/addsubcategory/{id}', 'App\Http\Controllers\Admin\CoffeeController@addSubcategory');
Route::get('/admin/subcategory', 'App\Http\Controllers\Admin\CoffeeController@subcategory');
Route::post('/admin/subcategory', 'App\Http\Controllers\Admin\CoffeeController@saveSubcategory');
Route::get('/admin/deletesubcategory/{id}', 'App\Http\Controllers\Admin\CoffeeController@deleteSubcategory');

//Slides 
Route::get('/admin/slides', 'App\Http\Controllers\Admin\StyleController@slides');
Route::get('/admin/addslides/{id}', 'App\Http\Controllers\Admin\StyleController@addslides');
Route::post('/admin/slides', 'App\Http\Controllers\Admin\StyleController@saveslides');
Route::get('/admin/deleteslides/{id}', 'App\Http\Controllers\Admin\StyleController@deleteslides');
Route::get('/admin/getAllSlides', 'App\Http\Controllers\Admin\StyleController@getslides');

// getdata
Route::get('/getfoods', 'App\Http\Controllers\FoodController@getfoods');
Route::get('/getcategory', 'App\Http\Controllers\FoodController@getCategory');
Route::get('/getsubcategory', 'App\Http\Controllers\FoodController@getSubCategory');
Route::get('/getsubcatwithfood', 'App\Http\Controllers\FoodController@getSubcategoryWithFood');
Route::get('/getcatwithfood', 'App\Http\Controllers\FoodController@getCategoryWithFood');
Route::get('/getextra', 'App\Http\Controllers\FoodController@getExtra');
Route::get('/getAllsubcategory', 'App\Http\Controllers\FoodController@getAllsubcategory');

///chamil
Route::get('/getFoodById/{id}', 'App\Http\Controllers\FoodController@getFoodById');


//usermanagement
Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register');
Route::post('/login', 'App\Http\Controllers\Auth\RegisterController@login');
Route::post('/profile/{id}', 'App\Http\Controllers\Auth\RegisterController@profile');

//order
Route::post('/neworder', 'App\Http\Controllers\OrderController@newOrder');
Route::get('/admin/orders', 'App\Http\Controllers\Admin\OrderControllerAdmin@orders');
Route::get('/admin/viewfoods/{id}', 'App\Http\Controllers\Admin\OrderControllerAdmin@viewFoods');
Route::get('/admin/purchasefood/{id}', 'App\Http\Controllers\Admin\OrderControllerAdmin@purchaseOrder');
Route::get('/admin/denyfreecofee/{id}', 'App\Http\Controllers\Admin\OrderControllerAdmin@denyFreeCofee');
Route::get('/admin/acceptfreecoffee/{id}', 'App\Http\Controllers\Admin\OrderControllerAdmin@AcceptFreeCofee');

//cart
Route::post('/cart_data', 'App\Http\Controllers\Cart_controller@store');


Route::post('/testorder', 'App\Http\Controllers\OrderController@testOrder');
