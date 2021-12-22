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

Route::group(['prefix' => 'admin/', 'namespace' => 'Admin', 'as' => 'admin.'], function() {
    Route::get('login', 'AuthController@index')->name("auth");
    Route::post('sign-in', 'AuthController@signIn')->name("sign-in");
    Route::group(['middleware' => ['role:admin','auth:web']], function() {
        Route::get('sign-out', 'AuthController@signOut')->name("sign-out");
        Route::get('', 'AdminController@index')->name("index");
        Route::get('qrcode/{slug}', 'AdminController@qrcode')->name("qrcode");
        Route::group(['as' => 'user.', 'prefix' => 'user'], function() {
            Route::get('', 'UserController@index')->name("index");
            Route::get('create', 'UserController@create')->name("create");
            Route::post('store', 'UserController@store')->name("store");
            Route::get('{id}/edit', 'UserController@edit')->name("edit");
            Route::post('{id}/update', 'UserController@update')->name("update");
            Route::get('{id}/delete', 'UserController@delete')->name("delete");
            Route::get('profile', 'UserController@profile')->name("profile");
            Route::post('profile/{id}/update', 'UserController@profileUpdate')->name("profile.update");
            Route::get('{id}/status', 'UserController@status')->name("status");
        });

        Route::group(['as' => 'about.', 'prefix' => 'about'], function() {
            Route::get('', 'UserController@about')->name("index");
            Route::post('store', 'UserController@aboutStore')->name("store");
        });

        Route::group(['as' => 'category.', 'prefix' => 'category'], function() {
            Route::get('', 'CategoryController@index')->name("index");
            Route::get('create', 'CategoryController@create')->name("create");
            Route::post('store', 'CategoryController@store')->name("store");
            Route::get('{id}/edit', 'CategoryController@edit')->name("edit");
            Route::post('{id}/update', 'CategoryController@update')->name("update");
            Route::get('{id}/delete', 'CategoryController@delete')->name("delete");
        });

        Route::group(['as' => 'up-comming.', 'prefix' => 'up-comming'], function() {
            Route::get('', 'UpCommingController@index')->name("index");
            Route::get('create', 'UpCommingController@create')->name("create");
            Route::post('store', 'UpCommingController@store')->name("store");
            Route::get('{id}/edit', 'UpCommingController@edit')->name("edit");
            Route::post('{id}/update', 'UpCommingController@update')->name("update");
            Route::get('{id}/delete', 'UpCommingController@delete')->name("delete");
        });

        Route::group(['as' => 'art-work.', 'prefix' => 'art-work'], function() {
            Route::get('', 'ArtWorkController@index')->name("index");
            Route::get('create', 'ArtWorkController@create')->name("create");
            Route::post('store', 'ArtWorkController@store')->name("store");
            Route::get('{id}/edit', 'ArtWorkController@edit')->name("edit");
            Route::post('{id}/update', 'ArtWorkController@update')->name("update");
            Route::get('{id}/delete', 'ArtWorkController@delete')->name("delete");
        });

        Route::group(['as' => 'product.', 'prefix' => 'product'], function() {
            Route::get('', 'ProductController@index')->name("index");
            Route::get('create', 'ProductController@create')->name("create");
            Route::post('store', 'ProductController@store')->name("store");
            Route::get('{id}/edit', 'ProductController@edit')->name("edit");
            Route::post('{id}/update', 'ProductController@update')->name("update");
            Route::get('{id}/delete', 'ProductController@delete')->name("delete");
        });

        Route::group(['as' => 'order.', 'prefix' => 'order'], function() {
            Route::get('', 'OrderController@index')->name("index");
        });

        Route::group(['as' => 'slider.', 'prefix' => 'slider'], function() {
            Route::get('', 'UserController@slider')->name("index");
            Route::post('store', 'UserController@sliderStore')->name("store");
        });

    });
});