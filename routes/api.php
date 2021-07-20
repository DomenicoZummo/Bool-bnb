<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::namespace('Api')
    ->group(function () {

        // Get services
        Route::get('/services', 'ServicesContoller@index');

        // Get filtered apartments
        Route::get('/filterapartments', 'AdvancedSearchController@index');

        // Get apartments details
        Route::get('apartments/{slug}', 'AdvancedSearchController@show');

        // Save messages
        Route::get('messages', 'MessagesController@store');
    });
