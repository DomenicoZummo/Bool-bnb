<?php

use Illuminate\Support\Facades\Auth;
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


Auth::routes();

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function () {
        // Admin Dashboard Route
        Route::get('/', 'HomeController@index')->name('home');

        // Apartments Routes
        Route::resource('/apartments', 'ApartmentController');

        // Messages Route
        Route::resource('/messages', 'MessagesController');
        
        Route::resource('/user', 'UserController');
    });

// Front-Office
Route::get('{any?}', function () {
    return view('guest/home');
})->where("any", ".*");
