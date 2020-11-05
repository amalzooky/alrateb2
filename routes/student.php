<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['namespace' => 'Adminstudent', 'middleware' => 'auth:student'], function () {
    Route::get('/', 'DashboardController@index')->name('student.dashboard');
    Route::get('/profile', 'DashboardController@profile')->name('student.profile');
    Route::get('/acount', 'DashboardController@acount')->name('student.acount');

    Route::get('/lacture', 'DashboardController@lacture')->name('student.lacture');
    Route::get('/teachers', 'DashboardController@teachers')->name('student.teachers');
    Route::get('/groups', 'DashboardController@groups')->name('student.groups');
    Route::get('/classes', 'DashboardController@classes')->name('student.classes');

    Route::get('/slidebar', 'DashboardController@sidebar')->name('student.sidebar');

//    // Logout
//    Route::post('logout', 'LoginStudentsController@logout')->name('logout');
});


Route::group(['namespace' => 'Adminstudent', 'middleware' => 'guest:student'], function () {
    Route::get('login', 'LoginStudentsController@getLogin')->name('get.student.login');
    Route::post('login', 'LoginStudentsController@login')->name('student.login');
});


