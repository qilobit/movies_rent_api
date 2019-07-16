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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//users
Route::post('user/store', 'UserController@store');
Route::post('user/auth', 'UserController@auth');

//movies
Route::post('movies/store', 'MoviesController@store');
Route::delete('movies/{id}', 'MoviesController@delete');
Route::get('movies', 'MoviesController@all');
