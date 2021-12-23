<?php

use Illuminate\Support\Facades\Route;
// use Session;
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

Route::get('/', function () {return view('login2');});


//admin login
Route::get('/admin', 'Admin\LoginController@index');

// dashboard
Route::get('/admin/dashboard', 'App\Http\Controllers\Admin\DashboardController@index');

//customers
Route::get('/admin/addcustomers/{id}', 'App\Http\Controllers\Admin\CustomerController@addCustomers');
Route::get('/admin/customers', 'App\Http\Controllers\Admin\CustomerController@Customers');
Route::post('/admin/customers', 'App\Http\Controllers\Admin\CustomerController@saveCustomers');
Route::get('/admin/deletecustomers/{id}', 'App\Http\Controllers\Admin\CustomerController@deleteCustomers');

Route::get('/customer_blacklist/{id}','App\Http\Controllers\Admin\CustomerController@blacklist');
Route::get('/customer_active/{id}','App\Http\Controllers\Admin\CustomerController@active');

Route::get('/admin/createCustomer','App\Http\Controllers\Admin\CustomerController@create');
Route::post('/admin/add_customer', 'App\Http\Controllers\Admin\CustomerController@add_customer');
Route::post('/admin/updateCustomerById/{id}', 'App\Http\Controllers\Admin\CustomerController@updateCustomerById');

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

/////////////////////
Route::get('/admin/addcategory/{id}', 'App\Http\Controllers\Admin\CoffeeController@addcategory');
Route::post('/admin/storecategory', 'App\Http\Controllers\Admin\CoffeeController@add_category');

//usermanagement

Route::post('/login', 'App\Http\Controllers\Auth\RegisterController@login');
Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register');
Route::post('/profile/{id}', 'App\Http\Controllers\Auth\RegisterController@profile');

Route::put('/updatePassword/{id}', 'App\Http\Controllers\Auth\ForgotPasswordController@updatePassword');


//order
Route::post('/neworder', 'App\Http\Controllers\OrderController@newOrder');
Route::get('/admin/orders', 'App\Http\Controllers\Admin\OrderControllerAdmin@orders');
Route::get('/admin/viewfoods/{id}', 'App\Http\Controllers\Admin\OrderControllerAdmin@viewFoods');
Route::get('/admin/purchasefood/{id}', 'App\Http\Controllers\Admin\OrderControllerAdmin@purchaseOrder');
Route::get('/admin/denyfreecofee/{id}', 'App\Http\Controllers\Admin\OrderControllerAdmin@denyFreeCofee');
Route::get('/admin/acceptfreecoffee/{id}', 'App\Http\Controllers\Admin\OrderControllerAdmin@AcceptFreeCofee');

Route::post('/admin/search_order_by_mobilenumber', 'App\Http\Controllers\Admin\OrderControllerAdmin@searchByMobileNumber');

Route::post('/testorder', 'App\Http\Controllers\OrderController@testOrder');

// Route::post('/cart_data', 'App\Http\Controllers\OrderController@testOrder');

Route::post('test', function(Request $request){
    dd($request->all());
});


// Route::post('/register','OrderController@register');

// Route::post('/cart_data', array('before' => 'csrf'), 'App\Http\Controllers\OrderController@testOrder');

// Route::get('/resetPassword', 'App\Http\Controllers\Auth\ForgotPasswordController@resetPassword');

Route::post('/cart_data', 'App\Http\Controllers\OrderController@testOrder');

// Events
Route::get('/events', 'App\Http\Controllers\EventController@index');
Route::get('/admin/viewEvents', 'App\Http\Controllers\EventController@viewAll');
Route::get('/admin/addevents/{id}', 'App\Http\Controllers\EventController@addevents');
Route::post('/admin/events2', 'App\Http\Controllers\EventController@add_Events');
Route::get('/admin/deleteevents/{id}', 'App\Http\Controllers\EventController@deleteEventss');

//boxes
Route::get('admin/boxes', 'App\Http\Controllers\BoxesController@getAllBoxes');
Route::get('admin/boxes_resi_first', 'App\Http\Controllers\BoxesController@getFirstresiBoxes');
Route::get('admin/order_box', 'App\Http\Controllers\OrderBoxController@AllBoxOrders');
Route::get('/admin/viewBoxItems/{id}', 'App\Http\Controllers\OrderBoxController@viewBoxItems');

Route::get('/admin/viewBoxes', 'App\Http\Controllers\BoxesController@viewAll');
Route::get('/admin/addboxes/{id}', 'App\Http\Controllers\BoxesController@addboxes');
Route::post('/admin/storeboxes', 'App\Http\Controllers\BoxesController@add_boxes');
Route::get('/admin/deleteboxes/{id}', 'App\Http\Controllers\BoxesController@deleteBoxes');

Route::get('/admin/purchasebox/{id}', 'App\Http\Controllers\OrderBoxController@purchaseOrder');
Route::post('/admin/search_order_box_by_mobilenumber', 'App\Http\Controllers\OrderBoxController@searchByMobileNumber');


Route::get('/admin/user', 'App\Http\Controllers\SystemUserController@create');
Route::post('/admin/user', 'App\Http\Controllers\SystemUserController@store');
Route::get('/admin/view_system_users', 'App\Http\Controllers\SystemUserController@index');
Route::get('/admin/update/{id}', 'App\Http\Controllers\SystemUserController@edit');
Route::get('/admin/deleteuser/{id}', 'App\Http\Controllers\SystemUserController@destroy');

Route::post('/login_validate', 'App\Http\Controllers\Auth\RegisterController@loginValidate');
Route::post('/syslogin', 'App\Http\Controllers\Auth\RegisterController@systemUserLoginCheck');
Route::get('/logout', 'App\Http\Controllers\Auth\RegisterController@systemuserlogout');

// open controller
Route::get('/admin/open', 'App\Http\Controllers\OpenController@open');
Route::get('/admin/editopentime', 'App\Http\Controllers\OpenController@createTime');
Route::post('/admin/editopentime', 'App\Http\Controllers\OpenController@store');


Route::get('/admin/addclose/{id}', 'App\Http\Controllers\OpenController@addclose');
Route::post('/admin/addclose', 'App\Http\Controllers\OpenController@add_close');
Route::get('/admin/deleteclose/{id}', 'App\Http\Controllers\OpenController@deleteclose');

//pos
Route::get('/admin/pos', 'App\Http\Controllers\POSController@index');
Route::get('/admin/get-all-foods', 'App\Http\Controllers\POSController@getAllFoods');
Route::post('/add/to/cart/', 'App\Http\Controllers\POSController@addToCart');
// Route::get('/add/to/cart/{id}', 'App\Http\Controllers\POSController@addToCart');
Route::get('cart', 'App\Http\Controllers\POSController@cart');

Route::get('/get_food_all', 'App\Http\Controllers\POSController@get_food_all');
Route::get('/get_box_all', 'App\Http\Controllers\POSController@get_box_all');

Route::get('/remove/to/cart/{id}', 'App\Http\Controllers\POSController@removeToCart');
Route::get('/loadcart', 'App\Http\Controllers\POSController@loadcart');
Route::get('getdatabyid/{id}', 'App\Http\Controllers\POSController@getDatabyId');
Route::get('/cart_info', 'App\Http\Controllers\POSController@cartInfo');



Route::post('/checkout', 'App\Http\Controllers\POSController@checkout');
Route::get('/loadcart_product', 'App\Http\Controllers\POSController@loadcartProduct');
Route::get('/cancel/to/cart', 'App\Http\Controllers\POSController@cancelToCart');
Route::get('/hold/{id}', 'App\Http\Controllers\POSController@hold');
Route::get('/count', 'App\Http\Controllers\POSController@count');
Route::get('/addtocart/holdInvoice/{id}', 'App\Http\Controllers\POSController@addtocart_holdInvoice');
Route::post('/add_customers', 'App\Http\Controllers\POSController@add_customers');

Route::post('/form_submit', 'App\Http\Controllers\POSController@form_submit');
Route::get('/testing', 'App\Http\Controllers\POSController@testing');
Route::get('/autocomplete2-searchCollector','App\Http\Controllers\POSController@searchCollector');

Route::get('/admin/monthlyCollection','App\Http\Controllers\Admin\DashboardController@monthlyCollection');
Route::get('/admin/todayOrders','App\Http\Controllers\Admin\DashboardController@todayOrders');
Route::get('/admin/todayOrdersCount','App\Http\Controllers\Admin\DashboardController@todayOrdersCount');
Route::get('/admin/monthlyrevenue','App\Http\Controllers\Admin\DashboardController@monthlyrevenue');
Route::get('/admin/total_customers','App\Http\Controllers\Admin\DashboardController@total_customers');
Route::get('/admin/card_orders','App\Http\Controllers\Admin\DashboardController@card_orders');
Route::get('/admin/cash_orders','App\Http\Controllers\Admin\DashboardController@cash_orders');
