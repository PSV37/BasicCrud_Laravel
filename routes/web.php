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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('verify/{email}/{token}','Auth\RegisterController@updateStatus');

Route::group(['middleware'=>'verifyEmail'],function(){
	Route::get('/home', 'HomeController@index')->name('home');
	Route::resource('/users', 'UserController');
	Route::get('/active', 'UserController@active_user');
	Route::get('/inactive', 'UserController@inactive_user');
	Route::get('/user/profile/{slug}/{id}', 'ProfileController@userProfile');
	Route::post('/user/profile', 'ProfileController@updateProfile');
	Route::post('/update/profile', 'ProfileController@userData');
});

	