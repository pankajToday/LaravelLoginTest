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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/product-create', 'ProductController@create')->name('productCreate');
Route::post('/product-store', 'ProductController@store')->name('productStore');
Route::get('/product-edit/{id}', 'ProductController@edit')->name('productEdit');
Route::post('/product-update/{id}', 'ProductController@update')->name('productUpdate');
Route::get('/product-delete/{id}', 'ProductController@destroy')->name('productDelete');
Route::post('/forget-password-email', 'Auth\ForgotPasswordController@sendForgetPasswordLink')->name('password.email');
Route::post('/forget-password-reset', 'Auth\ResetPasswordController@passwordUpdate')->name('forget.password.update');


