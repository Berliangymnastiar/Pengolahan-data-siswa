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

Route::get('/', 'PagesController@home');



Route::get('/login', 'AuthController@login')->name('login');
Route::post('/postLogin', 'AuthController@postLogin');
//Controller Logout
Route::get('/logout', 'AuthController@logout'); 



Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
    //Controller students
    Route::resource('students', 'StudentsController')->middleware('auth');
    Route::post('/students{student}/update', 'StudentsController@update')->middleware('auth');
    Route::get('/students/{student}/delete', 'StudentsController@destroy')->middleware('auth');
});

Route::group(['middleware' => ['auth', 'checkRole:admin,siswa']], function () {
     //Controller dashboards
    Route::get('/dashboards', 'DashboardsController@index');
});
