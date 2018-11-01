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

Route::get('/', 'HomeController@index')->name('home');
Route::match(['GET', 'POST'], '/adminlogin', 'HomeController@adminLogin')->name('adminlogin');

Route::get('/login', 'UserController@login')->name('login');
Route::get('/register', 'UserController@register')->name('register');


Route::get('/stk', 'StkController@index')->name('stk');
Route::match(['GET', 'POST'], '/stk/add', 'StkController@add');
Route::post('/stkcallback', 'StkController@callback')->name('stkcallback');


Route::get('/c2b', 'c2bController@index')->name('c2b');
Route::match(['GET', 'POST'], '/c2b/add', 'c2bController@add');
Route::post('/c2bvalidation', 'c2bController@c2bValidation')->name('c2bvalidation');
Route::post('/c2bconfirmation', 'c2bController@c2bConfirmation')->name('c2bconfirmation');



Route::get('/b2c', 'b2cController@index')->name('b2c');
Route::match(['GET', 'POST'], '/b2c/add', 'b2cController@add');
Route::post('/QueueTimeOutURL', 'b2cController@QueueTimeOutURL')->name('QueueTimeOutURL');
Route::post('/ResultURL', 'b2cController@ResultURL')->name('ResultURL');
