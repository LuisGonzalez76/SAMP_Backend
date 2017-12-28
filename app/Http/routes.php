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

//Route::get('sexo', 'v1\studentController@index');

Route::get('b/{id}', 'ActivityStatusController@show');

Route::get('api/facilities','v1\facilityController@index');

Route::get('api/organizations','v1\organizationController@index');

Route::post('api/facilities', 'v1\facilityController@store');

Route::get('api/facilities/{id}','v1\facilityController@show');

Route::get('api/departments','v1\facilityController@departments');

Route::get('api/departments/{code}', 'v1\facilityController@showDepartment');

Route::post('api/departments', 'v1\facilityController@storeDepartment');

Route::put('api/departments/{code}','v1\facilityController@updateDepartment');

Route::post('api/organizations','v1\organizationController@store');

Route::get('api/organizations/{id}','v1\organizationController@show');

Route::get('api/organization_types', 'v1\organizationController@allOrganizationTypes');

Route::get('api/organization_types/{code}','v1\organizationController@showOrganizationType');

Route::post('api/organization_types','v1\organizationController@storeOrganizationType');

Route::put('api/organization_types/{code}','v1\organizationController@updateOrganizationType');

Route::get('api/activities', 'v1\activityController@index');

Route::get('api/activities/pending','v1\activityController@countPending');

Route::get('api/activities/approved','v1\activityController@countApproved');

Route::get('api/activities/denied','v1\activityController@countDenied');

Route::get('api/activities/{id}','v1\activityController@show');

Route::get('api/users','v1\userController@index');

