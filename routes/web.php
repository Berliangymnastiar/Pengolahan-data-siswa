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

//Controller students
Route::resource('students', 'StudentsController');
Route::post('/students{student}/update', 'StudentsController@update');
Route::get('/students/{student}/delete', 'StudentsController@destroy');