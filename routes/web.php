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
    return view('homepage');
});

Route::get('art-work/{param}', 'HomeController@artWork')->name("art-work");
Route::get('up-comming/{param}', 'HomeController@upComming')->name("up-comming");
Route::get('store/', 'HomeController@store')->name("store");
Route::get('detail-product/{slug}', 'HomeController@detailProduct')->name("detail-product");
Route::get('detail-product-store/{slug}', 'HomeController@detailProductStore')->name("detail-product-store");

Route::get('about/cv', 'HomeController@cv')->name("about.cv");
Route::get('about/cv-periodic', 'HomeController@cvPeriodic')->name("about.cv.periodic");
Route::get('about/contact-us', 'HomeController@contactUs')->name("about.contact-us");
Route::get('profile', 'HomeController@profile')->name("auth.profile");
Route::post('update-profile', 'HomeController@updateProfile')->name("auth.profile.update");
Route::get('login', 'HomeController@login')->name("auth.login");
Route::post('do-login', 'HomeController@doLogin')->name("auth.do-login");
Route::post('do-register', 'HomeController@doRegister')->name("auth.do-register");
Route::get('logout', 'HomeController@logout')->name("auth.logout");

Route::post('orders', 'HomeController@orders')->name("orders");
Route::get('autenticate-product', 'HomeController@authenticationProduct')->name("authentication.product");
Route::post('autenticate-product-check', 'HomeController@authenticationProductCheck')->name("authentication.product.check");


Route::group(['as' => 'order.', 'prefix' => 'order'], function() {
    Route::post('add-to-cart', 'OrderController@addToCart')->name("add-to-cart");
    Route::post('checkout', 'OrderController@checkout')->name("checkout");
    Route::post('proced-checkout', 'OrderController@procedCheckout')->name("proced.checkout");
    Route::get('success', 'OrderController@success')->name("success");
});

