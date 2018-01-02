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
Route::get('api/activities/{id}','v1\activityController@show');
Route::get('api/activity/{email}','v1\activityController@showByUserEmail');

Route::get('api/users','v1\userController@index');
Route::get('api/users/{email}','v1\userController@show');
Route::post('api/activities','v1\activityController@store');
Route::put('api/counselorApproved/{id}','v1\activityController@counselorApproved');
Route::put('api/counselorDenied/{id}','v1\activityController@counselorDenied');
Route::put('api/managerApproved/{id}','v1\activityController@managerApproved');
Route::put('api/managerDenied/{id}','v1\activityController@managerDenied');
Route::put('api/adminApproved/{id}','v1\activityController@adminApproved');
Route::put('api/adminDenied/{id}','v1\activityController@adminDenied');

Route::get('api/students','v1\studentController@index');
//Route::get('api/students/{id}','v1\studentController@show');
Route::get('api/students/{email}','v1\studentController@showByEmail');
Route::post('api/students','v1\studentController@store');


Route::get('api/counselors','v1\counselorController@index');
Route::get('api/counselors/{id}','v1\counselorController@show');

Route::get('api/managers','v1\managerController@index');
Route::get('api/managers/{id}','v1\managerController@show');

Route::get('api/staff','v1\staffController@staffIndex');
Route::get('api/staff/{id}','v1\staffController@showStaff');
Route::post('api/staff','v1\staffController@storeStaff');

Route::get('api/admin','v1\staffController@adminIndex');
Route::get('api/admin/{id}','v1\staffController@showAdmin');
Route::post('api/admin','v1\staffController@storeAdmin');