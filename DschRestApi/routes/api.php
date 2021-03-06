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

Route::post('/get_token', 'AuthController@get_token')->name('token');
Route::post('/login', 'AuthController@login')->name('login');

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/logout', 'AuthController@logout')->name('logout');

    Route::resource('teacher', 'TeacherController');
});
