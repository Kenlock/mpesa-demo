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
Route::get('/login', 'UserController@login')->name('login');
Route::get('/register', 'UserController@register')->name('register');


Route::get('/hotels', 'HotelController@index')->name('hotels');
Route::match(['GET', 'POST'], '/hotels/add', 'HotelController@add');
Route::match(['GET', 'POST'], '/hotels/edit/{id}', 'HotelController@edit');

Route::get('/roomtypes', 'RoomTypeController@index')->name('roomtypes');
Route::match(['GET', 'POST'], '/roomtypes/add', 'RoomTypeController@add');
Route::match(['GET', 'POST'], '/roomtypes/edit/{id}', 'RoomTypeController@edit');

Route::get('/rooms', 'RoomController@index')->name('rooms');
Route::match(['GET', 'POST'], '/rooms/add', 'RoomController@add');
Route::match(['GET', 'POST'], '/rooms/edit/{id}', 'RoomController@edit');

Route::get('/menuitems', 'MenuItemsController@index')->name('menuitems');
Route::match(['GET', 'POST'], '/menuitems/add', 'MenuItemsController@add');
Route::match(['GET', 'POST'], '/menuitems/edit/{id}', 'MenuItemsController@edit');

Route::get('/booking', 'RoomBookingController@index')->name('booking');
Route::match(['GET', 'POST'], '/booking/add', 'RoomBookingController@add');
Route::match(['GET', 'POST'], '/booking/edit/{id}', 'RoomBookingController@edit');
Route::match(['GET', 'POST'], '/booking/saveSearch', 'RoomBookingController@saveSearch');
Route::get('/booking/roomdata', 'RoomBookingController@roomData');
Route::match(['GET', 'POST'], '/booking/saveRooms', 'RoomBookingController@saveRooms');
Route::match(['GET', 'POST'], '/booking/saveGuests', 'RoomBookingController@saveGuests');
Route::match(['GET', 'POST'], '/booking/saveBooking', 'RoomBookingController@saveBooking');


// Route::post('/hotels/save', 'HotelController@save');
