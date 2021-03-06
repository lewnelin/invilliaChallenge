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

/**
 * Rotas de Login e Tokens para API
 */
Route::group(['namespace' => 'App\Http\Controllers\Auth'], function () {
    Route::post('oauth/token', 'AuthController@auth');
    Route::post('login', 'AuthController@login');
});

Route::get('people', 'App\Http\Controllers\PersonController@list');
Route::get('orders', 'App\Http\Controllers\OrderController@list');
Route::get('users', 'App\Http\Controllers\UserController@list');
