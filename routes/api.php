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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


    // Route::auth();
    Route::post('register', 'UserController@register');
    Route::post('login', 'UserController@login');

    Route::get('user', 'UserController@getAuthenticatedUser')->middleware('jwt.verify');
    Route::get('logout', 'UserController@logout')->middleware('jwt.verify');
    Route::get('refresh', 'UserController@refresh')->middleware('jwt.verify'); // refresh token

    Route::get('book', 'TrialController@book');
    Route::get('bookall', 'TrialController@bookAuth')->middleware('jwt.verify');

    Route::group(['prefix' => 'session'], function () {
        Route::get('list', 'SessionController@list');
        Route::get('detail/{id_session}', 'SessionController@detail');
        Route::post('create', 'SessionController@create')->middleware('jwt.verify');
        Route::put('update/{id_session}', 'SessionController@update')->middleware('jwt.verify');
        Route::delete('delete/{id_session}', 'SessionController@delete')->middleware('jwt.verify');
    });
