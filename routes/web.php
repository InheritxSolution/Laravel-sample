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
Route::get('/', 'HomeController@page')->name('home.page');

//Route::get('/admin', function () {
//    return redirect()->route('login');
//});

Auth::routes();

Route::get('change-lang/{lang}', function($lang) {
	session(['Accept-Language' => $lang]);
	return redirect()->back();
})->name('app.setLocal');

Route::group(['middleware' => ['auth', 'preventBackHistory']], function() {
	//dashboard
	Route::get('/dashboard', 'HomeController@index')->name('home');
	
	//profile update
	Route::get('/profile', 'UserController@editProfile')->name('admin.editProfile');
	Route::patch('/profile', 'UserController@updateProfile');
	
	//change password
	Route::get('/change-password', 'UserController@editPassword')->name('admin.editPassword');
	Route::patch('/change-password', 'UserController@updatePassword');
	
	//User management
	Route::resource('/users', 'UserController');
	
	//CMS management
	Route::resource('/cms', 'CMSController');

	//Version management
	Route::resource('/version', 'VersionController');
});
