<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\User;
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



/////////admin login///////////////////////

Route::get('admin-signup','Admin\UserController@index')->name('admin-signup.index');
Route::post('/admin-signuptore','Admin\UserController@store')->name('admin-signup.store');
Route::get('admin-login','Admin\UserController@adminlogin')->name('admin-login.adminlogin');
Route::post('admin-adminstore','Admin\UserController@adminstore')->name('admin.adminstore');

//////////////////admin dashboard///////////////
Route::get('admin-dashboard','Admin\AdminController@index')->name('admin-dashboad.index');
Route::group(['middleware' => 'UserAuth'], function () {
    Route::get('admin-dashboard','Admin\AdminController@index')->name('admin-dashboad.index');

});
Route::get('admin-destroy','Admin\UserController@destroy')->name('admin.destroy');
