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
    Route::get('/goods/categories', 'GoodController@categories')->name('categories');
    Route::get('/goods/view/{id}', 'GoodController@view');
    Route::post('/goods/buy', 'GoodController@buy');



    //admin
    Route::group(['middleware'=>'admin'], function() {
        Route::get('/admin', 'Admin\AccountController@index')->name('admin');

        Route::get('/admin/create-good', 'Admin\AccountController@create_good');
        Route::get('/admin/create-cat', 'Admin\AccountController@create_cat');
        Route::post('/admin/store-good', 'Admin\AccountController@store_good');
        Route::post('/admin/store-cat', 'Admin\AccountController@store_cat');

//        Route::get('/admin/view/{id}', 'Admin\AccountController@view');
        Route::get('/admin/edit/{id}', 'Admin\AccountController@edit');
        Route::post('/admin/update/{id}', 'Admin\AccountController@update');
        Route::get('/admin/destroy/{id}', 'Admin\AccountController@destroy')->where(['id'=>'[0-9]']);

        Route::get('/admin/edit-cat/{id}', 'Admin\AccountController@edit_cat');
        Route::post('/admin/update-cat/{id}', 'Admin\AccountController@update_cat');
        Route::get('/admin/destroy-cat/{id}', 'Admin\AccountController@destroy_cat')->where(['id'=>'[0-9]']);
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
