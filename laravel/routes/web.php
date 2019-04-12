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
    return view('template.index');
});

// Route::get('/shop', function () {
//     return view('template.shop');
// });
Route::get('/index', 'home\indexController@show');
Route::get('/shop', 'home\shopController@show');
Route::get('/product-details', 'home\productDetailsController@show');
Route::get('/cart', 'home\cartController@show');
Route::get('/checkout', 'home\checkoutController@show');
Route::get('/login', 'home\loginController@show');
Route::get('/blog', 'home\blogController@show');
Route::get('/blog-single', 'home\blogSingleController@show');
Route::get('/contact-us', 'home\contactUsController@show');
/*Route::get('/tours/{id}',function(){
    return view('template.tours');
})->name('tours');
*/

//Route::get('/nilai/{value}','MhsController@showNilai');

Route::resource('/Mhs','MhsController');

