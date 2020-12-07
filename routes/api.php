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


Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');

Route::middleware(['log.route', 'jwt.verify'])->group(function () {
    // Route::auth();
    Route::get('user', 'UserController@getAuthenticatedUser');
    Route::get('logout', 'UserController@logout');
    Route::get('refresh', 'UserController@refresh'); // refresh token

    Route::get('book', 'TrialController@book');
    Route::get('bookall', 'TrialController@bookAuth');

    Route::group(['prefix' => 'session'], function () {
        Route::get('list', 'SessionController@list');
        Route::get('detail/{id_session}', 'SessionController@detail');
        Route::post('create', 'SessionController@create');
        Route::put('update/{id_session}', 'SessionController@update');
        Route::delete('delete/{id_session}', 'SessionController@delete');
    });

});

Route::group(['prefix' => 'session'], function () {
    Route::get('list', 'SessionController@list');
    Route::get('detail/{id_session}', 'SessionController@detail');
});
