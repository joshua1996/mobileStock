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

Route::get('/', 'mainController@home')->name('home');
Route::get('/salesHistory', 'mainController@salesHistory')->name('salesHistory');
Route::get('/supply', 'mainController@supply')->name('supply');
Route::get('/supplyHistory', 'mainController@supplyHistory')->name('supplyHistory');



Route::post('/sales', 'mainController@sales')->name('sales');
Route::post('/salesSearchDate', 'mainController@salesSearchDate')->name('salesSearchDate');
Route::post('/supply', 'mainController@supplyP')->name('supplyP');


