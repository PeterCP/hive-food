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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

/*----------------------------------------------------------------------------------------**
**----------------------------------- COMENSAL ROUTES ------------------------------------**
**----------------------------------------------------------------------------------------*/

Route::get('/comensal', 'ComensalController@index')->name('client');
Route::get('/gracias',  'ComensalController@thankyou')->name('thankyou');
Route::get('/error',    'ComensalController@error')->name('error');

/*----------------------------------------------------------------------------------------**
**------------------------------------- ADMIN ROUTES -------------------------------------**
**----------------------------------------------------------------------------------------*/

Route::get('/admin', 'AdminController@admin')->name('admin');
Route::get('/admin/estadisticas', 'AdminController@stats')->name('stats');
Route::get('/admin/fidelidad', 'AdminController@loyalty')->name('loyalty');
Route::get('/admin/menu', 'AdminController@menu')->name('menu');
Route::get('/admin/ordenes', 'AdminController@allOrders')->name('all_orders');
Route::get('/admin/ordenes/mes', 'AdminController@thisMonthOrders')->name('this_month_orders');
Route::get('/admin/ordenes/seis', 'AdminController@sixMonthOrders')->name('six_month_orders');
Route::get('/admin/ordenes/hoy', 'AdminController@todayOrders')->name('today_orders');
Route::get('/admin/platillos', 'AdminController@dishes')->name('dishes');
Route::get('/admin/prepagos', 'AdminController@prepayments')->name('prepayments');
Route::get('/admin/efectivo', 'AdminController@cash')->name('cash');
Route::get('/admin/usuarios', 'AdminController@users')->name('users');

/*----------------------------------------------------------------------------------------**
**------------------------------------ Resource ROUTES -----------------------------------**
**----------------------------------------------------------------------------------------*/

//Dishes
Route::resource('admin/dish', 'DishController', ['only' => ['destroy', 'store', 'update']]);
Route::get('admin/dish/edit/{id}', 'DishController@editDish');

//Menu
Route::get('/menu', 'MenuController@getMenu');
Route::get('admin/menu/remove/{id}', 'MenuController@removeDishFromMenu');
Route::post('admin/menu/add', 'MenuController@addDishesToMenu');
Route::post('admin/menu/add', 'MenuController@addDishesToMenu');

//Orders

Route::post('/order', 'OrderController@newOrder');
Route::get('/orders/{userId}', 'OrderController@getOrdersByUser');
Route::resource('admin/order', 'OrderController', ['only' => ['destroy', 'store', 'update']]);
Route::get('admin/order/changeStatus/{state}/{id}', 'OrderController@changeOrderStatus');
Route::get('admin/order/edit/{id}', 'OrderController@editOrder');

//Order Items
Route::resource('admin/orderItem', 'OrderItemController', ['only' => ['destroy', 'store', 'update']]);
Route::get('admin/orderItem/edit/{id}', 'OrderItemController@editOrderItem');

//Prepayments
Route::get('admin/prepayment/history/{id}', 'PrepaymentController@prepaymentHistory');
Route::get('admin/prepayment/reduce/{id}', 'PrepaymentController@reducePrepayment');
Route::get('admin/prepayment/add/{id}/{number}', 'PrepaymentController@addPrepayment');

//Cash
Route::get('admin/cash/history/{id}', 'PrepaymentController@cashHistory');
Route::get('admin/cash/reduce/{id}/{number}', 'PrepaymentController@reduceCash');
Route::get('admin/cash/add/{id}/{number}', 'PrepaymentController@addCash');

//Users
Route::resource('admin/user', 'UserController', ['only' => ['destroy', 'store', 'update']]);
Route::get('admin/user/edit/{id}', 'UserController@editUser');

//Loyalty
Route::get('admin/loyalty/redeem/{id}', 'LoyaltyController@redeemLoyaltyPoints');
Route::get('admin/loyalty/add/{id}/{number}', 'LoyaltyController@addLoyaltyPoints');
