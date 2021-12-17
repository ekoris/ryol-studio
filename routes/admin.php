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
    Route::group(['middleware' => 'auth:web'], function() {
        Route::get('sign-out', 'AuthController@signOut')->name("sign-out");
        Route::get('', 'AdminController@index')->name("index");
        
        Route::group(['as' => 'user.', 'prefix' => 'user'], function() {
            Route::get('', 'UserController@index')->name("index");
        });

        Route::group(['as' => 'about.', 'prefix' => 'about'], function() {
            Route::get('', 'UserController@about')->name("index");
        });

    });
});