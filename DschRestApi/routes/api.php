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

Route::resource('teacher', 'TeacherController');

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/logout', 'AuthController@logout')->name('logout');

    Route::resource('class', 'Classes\SchoolClassController');

    Route::resource('subject','Classes\SubjectController');

    Route::resource('student','Students\StudentController');

    Route::resource('academic_year', 'Settings\AcademicYearController');

    Route::resource('fee', 'Settings\ClassFeeController');

    Route::resource('student_class', 'Students\StudentClassController');

    Route::resource('fee_payment', 'Students\FeePaymentController');
});
