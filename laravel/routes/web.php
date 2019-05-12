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
    Session::put('account',"Account");
    return view('template.login');
});

Route::get('/index', 'home\indexController@show');
Route::post('/indexlogin', 'home\indexController@index');
Route::post('/index', 'home\indexController@store');
Route::get('/shop', 'home\shopController@show');
Route::get('/account', 'home\accountController@show');
Route::get('/product-details/{id_produk}', 'home\productDetailsController@show');
Route::get('/cart', 'home\cartController@show');
Route::get('/cartdel{id_transdetail}', 'home\cartController@destroy');
Route::post('/cart', 'home\cartController@store');
Route::get('/wishlist', 'home\wishlistController@show');
Route::get('/wishlistdel{id_wishlist}', 'home\wishlistController@destroy');
Route::post('/wishlist', 'home\wishlistController@store');
Route::post('/cartupdate', 'home\cartController@update');
Route::get('/checkout', 'home\checkoutController@show');
Route::post('/checkoutpay', 'home\checkoutController@store');
Route::get('/login', 'home\loginController@show');
Route::post('/login', 'home\loginController@store');
Route::get('/blog', 'home\blogController@show');
Route::get('/blog-single', 'home\blogSingleController@show');
Route::get('/contact-us', 'home\contactUsController@show');

Route::get('getsession','SessionController@accessSessionData');
Route::get('setsession','SessionController@storeSessionData');
Route::get('removesession','SessionController@deleteSessionData');



