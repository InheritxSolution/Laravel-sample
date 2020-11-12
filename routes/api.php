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

Route::group([
    'middleware' => 'api','prefix' => 'v1'
], function ($router) {

    Route::post('login', 'Api\v1\AuthController@login');
    Route::post('refresh', 'Api\v1\AuthController@refresh');

    Route::post('getVersion', 'Api\v1\VersionController@getAppVersion');

    Route::group(['middleware' => 'jwt.verify'], function ($router) {
		Route::post('me', 'Api\v1\AuthController@me');
    	Route::post('logout', 'Api\v1\AuthController@logout');
	});
});


