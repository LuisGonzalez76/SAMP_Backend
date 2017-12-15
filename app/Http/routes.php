<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('sexo', 'v1\studentController@index');

Route::get('b/{id}', 'ActivityStatusController@show');

Route::get('api/facilities','v1\facilityController@index');

Route::get('api/organizations','v1\organizationController@index');

Route::post('api/facilities', 'v1\facilityController@store');

Route::post('api/organizations','v1\organizationController@store');

