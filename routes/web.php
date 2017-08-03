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
    Route::get('/salesHistory/{startDate}/{endDate}', 'mainController@salesSearchDate')->name('salesSearchDate');
    Route::get('/supply', 'mainController@supply')->name('supply');
    Route::get('/supplyHistory', 'mainController@supplyHistory')->name('supplyHistory');
    Route::get('/supplyHistory/{startDate}/{endDate}', 'mainController@supplySearchDate')->name('supplySearchDate');

    //
    Route::post('/logout', 'userLoginController@logout')->name('logout');
    Route::post('/sales', 'mainController@sales')->name('sales');

//    Route::post('/salesSearchDate', 'mainController@salesSearchDate')->name('salesSearchDate');

    Route::post('/supply', 'mainController@supplyP')->name('supplyP');
   // Route::post('/supplySearchDate', 'mainController@supplySearchDate')->name('supplySearchDate');

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
    Route::get('/admin/salesHistory/{startDate}/{endDate}', 'adminController@salesSearchDate')->name('salesSearchDateAdmin');
    Route::get('/admin/supply', 'adminController@supply')->name('adminSupply');
    Route::get('/admin/supplyHistory', 'adminController@supplyHistory')->name('supplyHistoryAdmin');
    Route::get('/admin/supplyHistory/{startDate}/{endDate}', 'adminController@supplySearchDate')->name('supplyAdminSearchDate');
    Route::get('/admin/stock', 'adminController@stock')->name('stockAdmin');
    Route::get('/admin/stock/{stockname}', 'adminController@stockSearch')->name('stockSearchAdmin');

    Route::get('/admin/supplyPerson', 'adminController@supplyPerson')->name('supplyPerson');
    Route::get('/admin/user', 'adminController@userEdit')->name('userEditAdmin');
    Route::get('/admin/staff', 'adminController@staff')->name('staffAdmin');
    Route::get('/admin/stockType', 'adminController@stockType')->name('stockTypeAdmin');
    //
    Route::post('/admin/logout', 'adminLoginController@logout')->name('adminLogout');
    Route::post('/admin/sales', 'adminController@adminSalesP')->name('adminSalesP');
    Route::post('/admin/supply', 'adminController@adminSupplyP')->name('adminSupplyP');
    Route::post('/admin/stockEdit', 'adminController@stockEdit')->name('stockEditAdmin');
    Route::post('/admin/stockDelete', 'adminController@stockDelete')->name('stockDeleteAdmin');
    Route::post('/admin/stockAdd', 'adminController@stockAdd')->name('stockAddAdmin');
    Route::post('/admin/supplyPersonEdit', 'adminController@supplyPersonEdit')->name('supplyPersonEditAdmin');
    Route::post('/admin/supplyPersonAdd', 'adminController@supplyPersonAdd')->name('supplyPersonAddAdmin');
    Route::post('/admin/supplyPersonDelete', 'adminController@supplyPersonDelete')->name('supplyPersonDeleteAdmin');
    Route::post('/admin/userAdd', 'adminController@userAdd')->name('userAddAdmin');
    Route::post('/admin/userEdit', 'adminController@userEditP')->name('userEditAdminP');
    Route::post('/admin/userDelete', 'adminController@userDelete')->name('userDeleteAdmin');
    Route::post('/admin/staff', 'adminController@staffSelect')->name('staffSelectAdmin');
    Route::post('/admin/staffEdit', 'adminController@staffEdit')->name('staffEditAdmin');
    Route::post('/admin/staffDelete', 'adminController@staffDelete')->name('staffDeleteAdmin');
    Route::post('/admin/staffAdd', 'adminController@staffAdd')->name('staffAddAdmin');
    Route::post('/admin/stockTypeAdd', 'adminController@stockTypeAdd')->name('stockTypeAddAdmin');
    Route::post('/admin/stockTypeEdit', 'adminController@stockTypeEdit')->name('stockTypeEditAdmin');
    Route::post('/admin/stockTypeDelete', 'adminController@stockTypeDelete')->name('stockTypeDeleteAdmin');


});





