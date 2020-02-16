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

use Illuminate\Support\Facades\Route;

Route::get('/','PageController@index')->name('index');
Route::get('/product_type/{type}','PageController@productType')->name('product_type');
Route::get('/product_detail/{id}','PageController@productDetail')->name('product_detail');
Route::get('/contact','PageController@contact')->name('contact');
Route::get('/about','PageController@about')->name('about');
Route::get('/add-to-cart/{id}','PageController@addCart')->name('addCart');
Route::get('/del-cart/{id}','PageController@delCart')->name('delCart');
Route::get('/checkout','PageController@getCheckOut')->name('getCheckOut');
Route::post('/checkout','PageController@postCheckOut')->name('postCheckOut');
Route::get('/login','PageController@getLogin')->name('getLogin');
Route::post('/login','PageController@postLogin')->name('postLogin');
Route::get('/signup','PageController@getSignup')->name('getSignup');
Route::post('/signup','PageController@postSignup')->name('postSignup');
Route::get('/search','PageController@getSearch')->name('getSearch');

