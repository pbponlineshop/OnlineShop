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

Route::get('/', function () {
    return view('template.login');
});

Route::get('/index', 'home\indexController@show');
Route::post('/indexlogin', 'home\indexController@index');
Route::post('/index', 'home\indexController@store');
Route::get('/shop', 'home\shopController@show');
Route::get('/product-details', 'home\productDetailsController@show');
Route::get('/cart', 'home\cartController@show');
Route::get('/cartdel{id_transdetail}', 'home\cartController@destroy');
Route::post('/cart', 'home\cartController@store');
Route::get('/checkout', 'home\checkoutController@show');
Route::get('/login', 'home\loginController@show');
Route::post('/login', 'home\loginController@store');
Route::get('/blog', 'home\blogController@show');
Route::get('/blog-single', 'home\blogSingleController@show');
Route::get('/contact-us', 'home\contactUsController@show');

Route::get('getsession','SessionController@accessSessionData');
Route::get('setsession','SessionController@storeSessionData');
Route::get('removesession','SessionController@deleteSessionData');



