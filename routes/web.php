<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/logout','HomeController@getSignOut')->name('logout');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')
    ->middleware('verified');

Route::get('/member/profile', function () {
    // verified users only
})->middleware('verified');

// Change pasword
Route::get('/changpass','HomeController@getChangePassword')
    ->name('changepass');

Route::post('/changpass','HomeController@postChangePassword')
    ->name('postchangepass');

// information
Route::get('information','HomeController@information')
    ->name('information');

Route::post('postInformation','HomeController@postChangeInformation')
    ->name('postInformation');

Route::resource('/wallet','WalletController');

Route::resource('/transfer','TransferController');

Route::resource('/pay','PayController');

Route::resource('/collect','CollectController');

Route::get('exportPay', 'PayExportController@export')->name('exportPay');

Route::get('exportCollect', 'CollectExportController@export')->name('exportCollect');
