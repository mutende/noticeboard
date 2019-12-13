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


Route::resource('notice', 'NoticesController');

// Route::get('/', function(){
// return redirect()->route('task.index');
// });
Route::get('/', 'HomeController@index');
Route::get('users', 'AddUsersController@addusers')->name('add.users');
Route::get('roles', 'RolesController@addroles')->name('roles');
Route::post('roles/save','RolesController@store')->name('roles.store');

Auth::routes();
