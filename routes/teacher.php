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


Route::group(['namespace' => 'Adminteacher', 'middleware' => 'auth:teacher'], function () {
    Route::get('/', 'DashboardController@index')->name('teacher.dashboard');
    Route::get('/profile', 'DashboardController@profile')->name('teacher.profile');
    Route::get('/slidebar', 'DashboardController@sidebar')->name('teacher.sidebar');
    Route::get('/lacture', 'DashboardController@lacture')->name('teacher.lacture');
    Route::get('/teachers', 'DashboardController@teachers')->name('teacher.teachers');
    Route::get('/groups', 'DashboardController@groups')->name('teacher.groups');

    Route::get('/slidebar', 'DashboardController@sidebar')->name('teacher.sidebar');



});


Route::group(['namespace' => 'Adminteacher', 'middleware' => 'guest:teacher'], function () {
    Route::get('login', 'LoginTeachersController@getLogin')->name('get.teacher.login');
    Route::post('login', 'LoginTeachersController@login')->name('teacher.login');
//    Route::get('/logout', 'LoginTeachersController@logout');


});


