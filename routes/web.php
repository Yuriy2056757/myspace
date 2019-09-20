<?php

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

// Create route for AJAX likes
Route::post('likes', 'LikeController@ajaxRequest')->name('likes.post');

// Create standard RESTful routes
Route::resource('users', 'UserController', ['except' => ['store', 'destroy']]);