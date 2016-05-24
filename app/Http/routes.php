<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    //dd( Auth::user());
    return view('home');
});

Route::controllers([
	'auth'=>'Auth\AuthController',
	'password'=>'Auth\PasswordController',
]);


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

//Route::get('/', array('as'=>'articles','uses'=>'ArticleController@Index'));//another way, route for controller

Route::get('user/index', 'UserController@index');
Route::post('user/store', 'UserController@store');
Route::resource('user', 'UserController');

Route::get('customer/index', 'CustomerController@index');
Route::post('customer/store', 'CustomerController@store');
Route::resource('customer', 'CustomerController');

Route::get('products/order', 'ProductController@order');
Route::resource('products', 'ProductController');
Route::post('products/store', 'ProductController@store');



Route::post('products/creditcheck', 'ProductController@creditcheck');



Route::get('order/index', 'OrderController@index');
Route::resource('order', 'OrderController');

