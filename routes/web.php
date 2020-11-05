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
Route::resource('/', 'Front\pagesController');
Route::get('/login', 'Front\pagesController@login')->name('login');
Route::post('/logout', 'Front\pagesController@logout')->name('logout');
Route::get('/aboutus', 'Front\pagesController@aboutus')->name('aboutus');
Route::get('/gallery', 'Front\pagesController@gallery')->name('gallery');
Route::get('/actives', 'Front\pagesController@actives')->name('actives');
Route::get('/contactus', 'Front\pagesController@contactus')->name('contactus');
Route::get('/saidus', 'Front\pagesController@saidus')->name('saidus');
Route::get('/honor', 'Front\pagesController@honor')->name('honor');


// test virtual class room
Route::group(['prefix' => 'class-room'], function () {
    Route::post('/wiziq', 'Front\VirtualClassroom\VirtualClassroomController@storeWiziq');
});


//Route::get('/', function () {
//    return view('front.home');
//});

//Auth::routes();




// Route::group(['namespace' => 'Front', 'middleware' => 'guest:Auth'], function () {
//     Route::get('/login', 'pagesController@login')->name('login');
//     Route::post('login', 'pagesController@login')->name('admin.login');
// // });


######################tasks#############



