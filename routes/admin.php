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
    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
    Route::group(['middleware' => ['role:admin','auth:web']], function() {
        Route::get('sign-out', 'AuthController@signOut')->name("sign-out");
        Route::get('', 'AdminController@index')->name("index");
        Route::get('qrcode/{slug}', 'AdminController@qrcode')->name("qrcode");
        Route::get('qrcode-appreciation/{slug}', 'AdminController@qrcodeAppreciation')->name("qrcode-appreciation");
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

        Route::group(['as' => 'message.', 'prefix' => 'message'], function() {
            Route::get('', 'MessageController@index')->name("index");
        });

        Route::group(['as' => 'about.', 'prefix' => 'about'], function() {
            Route::get('', 'UserController@about')->name("index");
            Route::post('store', 'UserController@aboutStore')->name("store");
        });

        Route::group(['as' => 'statement.', 'prefix' => 'statement'], function() {
            Route::get('', 'StatementController@index')->name("index");
            Route::post('store', 'StatementController@store')->name("store");
        });

        Route::group(['as' => 'category.', 'prefix' => 'category'], function() {
            Route::get('', 'CategoryController@index')->name("index");
            Route::get('create', 'CategoryController@create')->name("create");
            Route::post('store', 'CategoryController@store')->name("store");
            Route::get('{id}/edit', 'CategoryController@edit')->name("edit");
            Route::post('{id}/update', 'CategoryController@update')->name("update");
            Route::get('{id}/delete', 'CategoryController@delete')->name("delete");
        });

        Route::group(['as' => 'variation.', 'prefix' => 'variation'], function() {
            Route::get('', 'VariationController@index')->name("index");
            Route::get('create', 'VariationController@create')->name("create");
            Route::post('store', 'VariationController@store')->name("store");
            Route::get('{id}/edit', 'VariationController@edit')->name("edit");
            Route::post('{id}/update', 'VariationController@update')->name("update");
            Route::get('{id}/delete', 'VariationController@delete')->name("delete");
        });

        Route::group(['as' => 'cv.', 'prefix' => 'cv'], function() {
            Route::get('', 'CvController@index')->name("index");
            Route::get('create', 'CvController@create')->name("create");
            Route::post('store', 'CvController@store')->name("store");
            Route::get('{id}/edit', 'CvController@edit')->name("edit");
            Route::post('{id}/update', 'CvController@update')->name("update");
            Route::get('{id}/delete', 'CvController@delete')->name("delete");
        });

        Route::group(['as' => 'authenticate.', 'prefix' => 'authenticate'], function() {
            Route::get('', 'AuthenticateProductController@index')->name("index");
            Route::get('create', 'AuthenticateProductController@create')->name("create");
            Route::post('store', 'AuthenticateProductController@store')->name("store");
            Route::get('{id}/edit', 'AuthenticateProductController@edit')->name("edit");
            Route::post('{id}/update', 'AuthenticateProductController@update')->name("update");
            Route::get('{id}/delete', 'AuthenticateProductController@delete')->name("delete");
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
            Route::get('{id}/action', 'OrderController@action')->name("action");
            Route::get('{id}/delete', 'OrderController@delete')->name("delete");
        });

        Route::group(['as' => 'slider.', 'prefix' => 'slider'], function() {
            Route::get('', 'UserController@slider')->name("index");
            Route::post('store', 'UserController@sliderStore')->name("store");
        });

        Route::group(['as' => 'json.', 'prefix' => 'json'], function() {
            Route::get('order-variation', 'JsonController@orderVariation')->name("order.variation");
            Route::get('order-edition', 'JsonController@orderEdition')->name("order.edition");
        });

    });
});