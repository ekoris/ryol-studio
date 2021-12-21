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

Route::get('about/cv', 'HomeController@cv')->name("about.cv");
Route::get('about/contact-us', 'HomeController@contactUs')->name("about.contact-us");

