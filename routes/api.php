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
    Route::get('me', 'UserController@me')->middleware('auth', 'verified');
    Route::post('logout', 'UserController@logout')->middleware('auth');
    Route::get('/', 'UserController@list')->middleware('auth');
    Route::post('/{id}/approve', 'UserController@approve')->middleware('auth');
    Route::post('/{id}/block', 'UserController@block')->middleware('auth');
    Route::get('/{id}', 'UserController@view')->middleware('auth', 'verified');
    Route::post('refresh', 'UserController@refresh')->middleware('auth');
    Route::get('email/verify/{id}', 'UserController@verifyEmail')->name('verification.verify')->middleware('signed');
    // Route::get('email/resend', 'UserController@resend')->name('verification.resend');
});

Route::group(['prefix' => 'challenges'], function () {

    Route::post('/', 'ChallengeController@create')->middleware('auth', 'verified');
    Route::get('/', 'ChallengeController@list')->middleware('auth', 'verified');
    Route::post('/{id}/finish', 'ChallengeController@finish')->middleware('auth', 'verified');
    Route::post('/{id}/submit', 'ChallengeController@submit')->middleware('auth');
});

Route::group(['prefix' => 'challenge-submittions'], function () {
    Route::get('/', 'ChallengeSubmittionController@list')->middleware('auth');
    Route::post('/{id}/approve', 'ChallengeSubmittionController@approve')->middleware('auth');
    Route::post('/{id}/reject', 'ChallengeSubmittionController@reject')->middleware('auth');
    Route::post('/{id}/decline', 'ChallengeSubmittionController@decline')->middleware('auth');
});

Route::group(['prefix' => 'programs'], function () {

    Route::get('/', 'ProgramController@list');
});

Route::group(['prefix' => 'user-roles'], function () {

    Route::get('/', 'UserRoleController@list');
});