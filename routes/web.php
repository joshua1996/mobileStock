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




Route::group(['middleware' => 'user'], function() {
    //
    Route::get('/login', 'userLoginController@userLogin')->name('login');
    //
    Route::post('/login', 'userLoginController@login')->name('loginP');


});

Route::group(['middleware' => 'notUser'], function (){
    //
    Route::get('/', 'mainController@home')->name('home');
    Route::get('/salesHistory', 'mainController@salesHistory')->name('salesHistory');
    Route::get('/supply', 'mainController@supply')->name('supply');
    Route::get('/supplyHistory', 'mainController@supplyHistory')->name('supplyHistory');

    //
    Route::post('/logout', 'userLoginController@logout')->name('logout');
    Route::post('/sales', 'mainController@sales')->name('sales');
    Route::post('/salesSearchDate', 'mainController@salesSearchDate')->name('salesSearchDate');
    Route::post('/supply', 'mainController@supplyP')->name('supplyP');
    Route::post('/supplySearchDate', 'mainController@supplySearchDate')->name('supplySearchDate');

});



Route::group(['middleware' => 'admin'], function() {
    //
    Route::get('/admin/login', 'adminLoginController@adminLogin');
    //
    Route::post('/admin/login', 'adminLoginController@login')->name('adminLoginP');

});
Route::group(['middleware' => 'notAdmin'], function (){
    //
    Route::get('/admin/sales', 'adminController@sales')->name('adminSales');
    Route::get('/admin/salesHistory', 'adminController@salesHistory')->name('salesHistoryAdmin');
    //
    Route::post('/admin/logout', 'adminLoginController@logout')->name('adminLogout');
    Route::post('/admin/sales', 'adminController@adminSalesP')->name('adminSalesP');
});





