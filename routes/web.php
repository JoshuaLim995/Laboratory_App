<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::resource('/inventory', 'InventoryController');

// Route::resource('/category', 'CategoryController');

Route::resource('/user', 'UserController');

Route::resource('/loan', 'LoanController');

Route::resource('/reservation', 'ReservationController');

Route::resource('/locker', 'LockerController');

Route::get('/calendar', 'ReservationController@showCalendar')->name('reservation.showCalendar');

Route::get('/loan/{loan}/approval/{token}', 'LoanController@approval')->name('loan.approval');
Route::put('/loan/{loan}/approve_quantity', 'LoanController@approve_quantity')->name('loan.approve_quantity');

Route::put('/loan/{loan}/recieved', 'LoanController@recieved')->name('loan.recieved');

Route::get('/get_user_datatable', 'UserController@get_datatable')->name('user.get_datatable');
Route::get('/get_inventory_datatable', 'InventoryController@get_datatable')->name('inventory.get_datatable');
Route::get('/get_category_datatable', 'CategoryController@get_datatable')->name('category.get_datatable');

Route::get('/get_loan_datatable', 'LoanController@get_datatable')->name('loan.get_datatable');
Route::get('/get_locker_datatable', 'LockerController@get_datatable')->name('locker.get_datatable');
Route::get('/get_reservation_datatable', 'ReservationController@get_datatable')->name('reservation.get_datatable');


Route::get('/rentLocker', 'RentLockerController@index')->name('rentLocker.index');
Route::post('/rentLocker', 'RentLockerController@store')->name('rentLocker.store');



Route::get('/profile', 'ProfileController@index')->name('profile.index');
Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
Route::put('/profile/edit', 'ProfileController@update')->name('profile.update');


Route::get('/user/{user}/delete', 'UserController@delete')->name('user.delete');
Route::get('/category/{category}/delete', 'CategoryController@delete')->name('category.delete');
Route::get('/inventory/{inventory}/delete', 'InventoryController@delete')->name('inventory.delete');
Route::get('/locker/{locker}/delete', 'LockerController@delete')->name('locker.delete');
Route::get('/reservation/{reservation}/delete', 'ReservationController@delete')->name('reservation.delete');


Route::get('/loan/{loan}/cancel', 'LoanController@cancel')->name('loan.cancel');


Route::get('/return', 'ReturnController@index')->name('return.index');
Route::post('/return', 'ReturnController@searchLoan')->name('return.searchLoan');

Route::get('/loan/{loan}/return', 'ReturnController@returnItem')->name('return.returnItem');
Route::put('/loan/{loan}/return', 'ReturnController@store')->name('return.store');

Route::put('/loan/{loan}/reminder', 'ReminderController@sendReminder')->name('reminder.sendReminder');



Route::get('/reminder', 'ReminderController@index')->name('reminder.index');
Route::post('/reminder', 'ReminderController@sendMultipleReminders')->name('reminder.sendMultipleReminders');
Route::get('/get_reminder_datatable', 'ReminderController@get_datatable')->name('reminder.get_datatable');


Route::resource('/transaction', 'TransactionController');
// Route::post('/selectAjax', 'TransactionController@selectAjax')->name('transaction.selectAjax');

Route::post('select-ajax', ['as'=>'select-ajax','uses'=>'TransactionController@selectAjax']);


Route::resource('/location', 'ItemLocationController');
Route::get('/location/{location}/delete', 'ItemLocationController@delete')->name('location.delete');


Route::get('/getItemLocations', 'DataTableController@getItemLocations')->name('getItemLocations');
Route::get('/getInventoryTransaction', 'DataTableController@getInventoryTransaction')->name('getInventoryTransaction');

Route::get('/reg_approve/{user}', 'UserController@registrationApproval')->name('newRegistrationApproval');