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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('register', 'JWTAuthController@register');
    Route::post('login', 'JWTAuthController@login');
    Route::post('logout', 'JWTAuthController@logout');
    Route::post('refresh', 'JWTAuthController@refresh');
    Route::get('profile', 'JWTAuthController@profile');
});

Route::group([
    'middleware' => 'api'
], function ($router) {
    Route::get('/absensi', 'AbsensiController@index');
    Route::get('/absensi/{id}', 'AbsensiController@show');
    Route::post('/absensi', 'AbsensiController@store');
    Route::patch('/absensi/{id}', 'AbsensiController@update');
    Route::delete('/absensi/{id}', 'AbsensiController@destroy');
});
