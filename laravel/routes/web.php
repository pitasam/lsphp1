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
    return view('welcome');
});

Route::group(['middleware'=>'auth'], function() {

    Route::get('/goods', 'GoodController@index')->name('goods');
    Route::get('/goods/view/{id}', 'GoodController@view');

    Route::get('/categories', 'CategoryController@index')->name('categories');
    Route::post('/goods/buy', 'GoodController@buy');



    //admin
    Route::group(['middleware'=>'admin','prefix' => 'admin'], function() {
        Route::get('/admin', 'Admin\AccountController@index')->name('admin');

        Route::get('/create-good', 'Admin\AccountController@create_good');
        Route::get('/create-cat', 'Admin\AccountController@create_cat');
        Route::post('/store-good', 'Admin\AccountController@store_good');
        Route::post('/store-cat', 'Admin\AccountController@store_cat');

//      Route::get('/view/{id}', 'Admin\AccountController@view');
        Route::get('/edit/{id}', 'Admin\AccountController@edit');
        Route::post('/update/{id}', 'Admin\AccountController@update');
        Route::get('/destroy/{id}', 'Admin\AccountController@destroy')->where(['id'=>'[0-9]']);

        Route::get('/edit-cat/{id}', 'Admin\AccountController@edit_cat');
        Route::post('/update-cat/{id}', 'Admin\AccountController@update_cat');
        Route::get('/destroy-cat/{id}', 'Admin\AccountController@destroy_cat')->where(['id'=>'[0-9]']);
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
