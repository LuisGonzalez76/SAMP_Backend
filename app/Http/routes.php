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
//Route::get('b/{id}', 'ActivityStatusController@show');
Route::get('api/sendCM/{email}','v1\userController@sendEmailCM');

Route::get('api/sendSA/{email}','v1\userController@sendEmailStudentAp');
Route::get('api/sendSD/{email}','v1\userController@sendEmailStudentDen');
Route::get('api/sendTXT/{email}','v1\userController@sendEmailText');

//Facility Routes
Route::get('api/facilities','v1\facilityController@index');//bien-getFacilities
Route::post('api/facilities', 'v1\facilityController@store'); //bien-createFacilities
Route::put('api/facilities/{id}','v1\facilityController@update');
Route::get('api/facilities/{id}','v1\facilityController@show');//bien
Route::post('api/facilities/{fid}/addManager/{mid}','v1\facilityController@managerToFacility');//new route
Route::get('api/facilities/managers/{id}','v1\facilityController@facilitiesManagers');
Route::delete('api/facilities/managers/{fid}/all','v1\facilityController@facilitiesManagerRemoveAll');
Route::delete('api/facilities/managers/{fid}/{mid}','v1\facilityController@facilitiesManagerRemove');


//Organization Routes
Route::get('api/organizations','v1\organizationController@index');
Route::post('api/organizations','v1\organizationController@store');
Route::put('api/organizations/{id}','v1\organizationController@update');
Route::get('api/organizations/{id}','v1\organizationController@show');
Route::get('api/userOrganizations/{email}','v1\organizationController@getByUser');
Route::post('api/organizations/{oid}/addMember/{sid}/role/{rid}','v1\organizationController@memberToOrganization');
Route::post('api/organizations/{oid}/addCounselor/{cid}','v1\organizationController@counselorToOrganization');// new route

Route::delete('api/organizations/members/delete/{sid}/{oid}','v1\organizationController@organizationMemberRemove');
Route::get('api/organizations/members/{id}','v1\organizationController@organizationMembers');
Route::delete('api/organizations/counselors/delete/all/{oid}','v1\organizationController@organizationCounselorRemoveAll');
Route::delete('api/organizations/counselors/delete/{cid}/{oid}','v1\organizationController@organizationCounselorRemove');
Route::get('api/organizations/counselors/{id}','v1\organizationController@organizationCounselors');
Route::get('api/organizations/activities/{id}','v1\organizationController@organizationActivities');


Route::get('api/organization_types', 'v1\organizationController@allOrganizationTypes');
Route::get('api/organization_types/{code}','v1\organizationController@showOrganizationType');
Route::post('api/organization_types','v1\organizationController@storeOrganizationType');
Route::put('api/organization_types/{code}','v1\organizationController@updateOrganizationType');
Route::get('api/organization_roles','v1\organizationController@allOrganizationRoles');

Route::get('api/organizationCounselors','v1\organizationController@organizationsWithCounselor');
Route::get('api/facilitiesWithManager','v1\facilityController@facilitiesWithManager');



//Activities Routes
Route::get('api/activities', 'v1\activityController@index');
Route::get('api/activities/{id}','v1\activityController@show');
Route::get('api/activity/{email}','v1\activityController@showByUserEmail');
Route::get('api/activityType','v1\activityController@getTypes');

Route::post('api/activities','v1\activityController@store');
Route::put('api/counselorApproved/{id}','v1\activityController@counselorApproved');
Route::put('api/counselorDenied/{id}','v1\activityController@counselorDenied');
Route::put('api/managerApproved/{id}','v1\activityController@managerApproved');
Route::put('api/managerDenied/{id}','v1\activityController@managerDenied');
Route::put('api/adminApproved/{id}','v1\activityController@adminApproved');
Route::put('api/adminDenied/{id}','v1\activityController@adminDenied');
Route::post('api/adminStore','v1\activityController@storeByAdmin');

Route::get('api/activityByOrg/{id}','v1\activityController@activityByOrg');
Route::get('api/activityByFacility/{id}','v1\activityController@activityByFacility');
Route::put('api/updateType/{id}','v1\activityController@updateType');


//User Routes
Route::get('api/users','v1\userController@index');
Route::get('api/users/{email}','v1\userController@show');

//Student routes
Route::get('api/students','v1\studentController@index');
Route::get('api/students/{id}','v1\studentController@show');
//Route::get('api/students/{email}','v1\studentController@showByEmail');
Route::post('api/students','v1\studentController@store');
Route::put('api/students/{id}','v1\studentController@update');


//Counselor routes
Route::get('api/counselors','v1\counselorController@index');
Route::get('api/counselors/{id}','v1\counselorController@show');
Route::post('api/counselors','v1\counselorController@store');
Route::put('api/counselors/{id}','v1\counselorController@update');

//Manager Routes
Route::get('api/managers','v1\managerController@index');
Route::get('api/managers/{id}','v1\managerController@show');
Route::post('api/managers','v1\managerController@store');
Route::put('api/managers/{id}','v1\managerController@update');


//Staff Routes
Route::get('api/staff','v1\staffController@staffIndex');
Route::get('api/staff/{id}','v1\staffController@showStaff');
Route::post('api/staff','v1\staffController@storeStaff');
Route::put('api/staff/{id}','v1\staffController@update');

Route::get('api/admin','v1\staffController@adminIndex');
Route::get('api/admin/{id}','v1\staffController@showAdmin');
Route::post('api/admin','v1\staffController@storeAdmin');

//Statistic Routes
Route::post('api/report','v1\activityController@report');
Route::post('api/denied','v1\activityController@countDenied');
Route::post('api/approved','v1\activityController@countApproved');
Route::post('api/pending','v1\activityController@countPending');
Route::post('api/request','v1\activityController@FacilityRequests');
Route::post('api/status','v1\activityController@ActivitiesStatus');

