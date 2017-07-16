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

//Route::get('/', function () {
//    return view('welcome');
//});

//user get

Route::get('/salesHistory', 'mainController@salesHistory')->name('salesHistory');
Route::get('/supply', 'mainController@supply')->name('supply');
Route::get('/supplyHistory', 'mainController@supplyHistory')->name('supplyHistory');

Route::group(['middleware' => 'user'], function() {
    Route::get('/login', 'mainController@login')->name('login');
});

Route::group(['middleware' => 'notUser'], function (){
    Route::get('/', 'mainController@home')->name('home');
});

//user post
Route::post('/sales', 'mainController@sales')->name('sales');
Route::post('/salesSearchDate', 'mainController@salesSearchDate')->name('salesSearchDate');
Route::post('/supply', 'mainController@supplyP')->name('supplyP');
Route::post('/login', 'userLoginController@login')->name('loginP');
Route::post('/logout', 'userLoginController@logout')->name('logout');


//admin get
Route::group(['middleware' => 'admin'], function() {
    Route::get('/admin/login', 'adminLoginController@adminLogin');

});
Route::group(['middleware' => 'notAdmin'], function (){
    Route::get('/admin/sales', 'adminController@sales');
});


//admin post
Route::post('/admin/login', 'adminLoginController@login')->name('adminLoginP');


