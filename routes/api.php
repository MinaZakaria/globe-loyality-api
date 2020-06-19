<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => 'users'], function () {

    Route::post('auth', 'UserController@authenticate');
    Route::post('register', 'UserController@register');
    Route::get('me', 'UserController@me')->middleware('auth:api', 'verified');
    Route::post('logout', 'UserController@logout')->middleware('auth:api');
    Route::post('refresh', 'UserController@refresh')->middleware('auth:api');
    Route::get('email/verify/{id}', 'UserController@verifyEmail')->name('verification.verify')->middleware('signed');
    // Route::get('email/resend', 'UserController@resend')->name('verification.resend');
});