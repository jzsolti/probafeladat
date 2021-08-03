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


Route::post('login', 'App\Http\Controllers\SpaAuth\LoginController@login');
Route::post('logout', 'App\Http\Controllers\SpaAuth\LoginController@logout');
Route::post('user/status', 'App\Http\Controllers\SpaAuth\LoginController@loggedIn');

Route::middleware(['auth:sanctum'])->group(function () {
    
    Route::prefix('user/vehicles')->group(function () {
        Route::get('/', 'App\Http\Controllers\VehicleController@index');
        Route::get('/{vehicle}', 'App\Http\Controllers\VehicleController@show');
        Route::post('/create', 'App\Http\Controllers\VehicleController@create');
        Route::put('/{vehicle}', 'App\Http\Controllers\VehicleController@update');
        Route::delete('/{vehicle}', 'App\Http\Controllers\VehicleController@delete');
    });

    Route::prefix('checksheets')->group(function () {
        Route::get('/', 'App\Http\Controllers\CheckSheetController@index');
        Route::get('{checkSheet}', 'App\Http\Controllers\CheckSheetController@show');
        Route::post('/create/{vehicle}', 'App\Http\Controllers\CheckSheetController@create');
        Route::put('/{checkSheet}', 'App\Http\Controllers\CheckSheetController@update');
        Route::delete('/{checkSheet}', 'App\Http\Controllers\CheckSheetController@delete');
    });
});