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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::resource('/inventory', 'InventoryController');

Route::resource('/category', 'CategoryController');

Route::resource('/user', 'UserController');

Route::resource('/loan', 'LoanController');

Route::resource('/reservation', 'ReservationController');



Route::get('/loan/{loan}/approval/{token}', 'LoanController@approval')->name('loan.approval');

Route::resource('/locker', 'LockerController');

Route::get('/exit', function () {
    return view('exit');
})->name('exit');


Route::get('/get_inventory_datatable', 'InventoryController@get_datatable')->name('inventory.get_datatable');

Route::get('/get_loan_datatable', 'LoanController@get_datatable')->name('loan.get_datatable');
