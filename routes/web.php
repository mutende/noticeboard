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
Route::put('notice/{id}/suspend', 'NoticesController@suspend')->name('notice.suspend');

// Route::get('/', function(){
// return redirect()->route('task.index');
// });
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::get('users', 'AddUsersController@addusers')->name('add.users');
Route::post('users/save','AddUsersController@store')->name('users.store');
Route::delete('user/{id}/delete','AddUsersController@destroy')->name('user.delete');
Route::get('user/{id}/suspend', 'AddUsersController@suspend')->name('user.suspend');
Route::put('user/{id}/update','AddUsersController@update')->name('user.update');
Route::get('user/{id}/profile','AddUsersController@editprofile')->name('user.edit.profile');
Route::put('user/{id}/profile','AddUsersController@updateprofile')->name('user.update.profile');

Route::get('roles', 'RolesController@addroles')->name('roles');
Route::post('roles/save','RolesController@store')->name('roles.store');
Route::delete('role/{id}/delete','RolesController@destroy')->name('role.delete');
Route::put('role/{id}/update','RolesController@update')->name('role.update');

Route::get('templates', 'TemplateController@index')->name('templates.home');
Route::post('templates', 'TemplateController@store')->name('templates.store');
Route::put('template/{id}/edit','TemplateController@update')->name('template.update');
Route::delete('template/{id}/delete','TemplateController@destroy')->name('template.delete');

Auth::routes();
