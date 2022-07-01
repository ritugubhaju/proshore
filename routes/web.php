<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');
Auth::routes();



Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

    Route::group(['as' => 'event.', 'prefix' => 'event'], function () {
        Route::get('', 'Backend\EventController@index')->name('index');
        Route::get('create', 'Backend\EventController@create')->name('create');
        Route::post('', 'Backend\EventController@store')->name('store');
        Route::put('{event}', 'Backend\EventController@update')->name('update');
        Route::get('{event}/edit', 'Backend\EventController@edit')->name('edit');
        Route::get('/delete/{id}', 'Backend\EventController@destroy')->name('destroy');

    });
    Route::get('filter', 'Backend\EventController@searchByFilter')->name('filter');
});




