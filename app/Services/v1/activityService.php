<?php
namespace App\Services\v1;

use App\activityType;
use App\Providers\v1\studentServiceProvider;
use App\student;
use App\activity;
use App\counselor;
use App\organization;
use App\facility;
use App\facilitiesManager;
use App\user;

class activityService{
    public function getActivities(){
        $activity  = activity::with('student','organization.counselors',
            'facility.managers','status','counselor_status',
            'manager_status','type')->get();
        return $activity;
    }

    public function getActivity($id){
        $activity = activity::where('id','=',$id)->with('student')->with('organization.counselors')
            ->with('facility.managers')->with('status','type')
            ->with('counselor_status')->with('manager_status')
            ->get();
        return $activity;
    }

    public function getActivityByUser($email){
        $user = user::where('userEmail',$email)->get()->first();
        $u_json = json_decode($user);
        $type = $u_json->userType_code;

        if($type == 1){
            return activity::with('student','organization','facility',
                'status','counselor_status','manager_status','type')->get();

        }
        if($type == 2){
            return activity::with('student','organization','facility',
                'status','counselor_status','manager_status','type')->get();
        }
        if($type == 3){
            $student = user::where('userEmail',$email)->with('students','type')->get()->first();
            $decoded = json_decode($student);
            $u_id = $decoded->students[0]->id;
            return activity::where('student_id',$u_id)->with('student','organization','facility',
                'status','counselor_status','manager_status','type')->get();
        }
        if($type == 4){
            $counselor = user::where('userEmail',$email)->with('counselors','type')->get()->first();
            $decoded = json_decode($counselor);
            $u_id = $decoded->counselors[0]->id;
            $orgs = counselor::where('id',$u_id)->with('organizations')->get()->first();
            $o_json = json_decode($orgs);
            $org_ids = [];
            $size = sizeof($o_json->organizations);
           // return $size;
            for($i=0;$i<$size;$i++){
                $org_ids [] = $o_json->organizations[$i]->id;
            }

            $activities = activity::whereIn('organization_id',$org_ids)->with('student','organization','facility',
                'status','counselor_status','manager_status','type')->get();
            return $activities;

        }
        if($type == 5){
            $manager = user::where('userEmail',$email)->with('managers','type')->get()->first();
            $decoded = json_decode($manager);
            $u_id = $decoded->managers[0]->id;

            $fac = facilitiesManager::where('id',$u_id)->with('facilities')->get()->first();
            $f_json = json_decode($fac);
            $fac_ids = [];
            $size = sizeof($f_json->facilities);

            for($i=0;$i<$size;$i++){
                $fac_ids [] = $f_json->facilities[$i]->id;
            }

            $activities = activity::whereIn('facility_id',$fac_ids)->with('student','organization','facility',
                'status','counselor_status','manager_status','type')->get();
            return $activities;

        }
    }

    public function storeActivity($request){
        if($request!=null){
            $start = $request['activityStart'];
            $end = $request['activityEnd'];
            $startA = strtotime($start);
            $endA = strtotime($end);
            $activity = activity::create([
                'student_id'=>$request['student_id'],
                'organization_id'=>$request['organization_id'],
                'facility_id'=>$request['facility_id'],
                'staff_id'=>$request['staff_id'],
                'activityName'=>$request['activityName'],
                'activityDescription'=>$request['activityDescription'],
                'attendantsNumber'=>$request['attendantsNumber'],
                'activityDate'=>$request['activityDate'],
                'activityStart'=>$startA,
                'activityEnd'=>$endA,
                'hasFood'=>$request['hasFood'],
                'guestName'=>$request['guestName'],
                'activityStatus_code'=>$request['activityStatus_code'],
                'counselorStatus_code'=>$request['counselorStatus_code'],
                'managerStatus_code'=>$request['managerStatus_code'],
                'activityType_code'=>$request['activityType_code'],
                'counselorComment'=>$request['counselorComment'],
                'managerComment'=>$request['managerComment'],
                'staffComment'=>$request['staffComment'],
                ]);
            return $activity;
        }
        else {
            return response() -> json(['message' => 'No data is present in request!'], 200);
        }
    }

    public function counselorApproved($request,$id){
        $activity = activity::where('id',$id)->get()->first();
        $activity->counselorStatus_code = 2;
        $activity->counselorComment = $request['counselorComment'];
        $activity->save();
        return $activity;
    }
    public function counselorDenied($request,$id){
        $activity = activity::where('id',$id)->get()->first();
        $activity->counselorStatus_code = 3;
        $activity->counselorComment = $request['counselorComment'];
        $activity->save();
        return $activity;
    }

    public function managerApproved($request,$id){
        $activity = activity::where('id',$id)->get()->first();
        $activity->managerStatus_code = 2;
        $activity->managerComment = $request['managerComment'];
        $activity->save();
        return $activity;
    }
    public function managerDenied($request,$id){
        $activity = activity::where('id',$id)->get()->first();
        $activity->managerStatus_code = 3;
        $activity->managerComment = $request['managerComment'];
        $activity->save();
        return $activity;
    }

    public function adminApproved($request,$id){
        $activity = activity::where('id',$id)->get()->first();
        $activity->activityStatus_code = 2;
        $activity->staffComment = $request['staffComment'];
        $activity->hasFood = $request['hasFood'];
        $activity->activityType_code = $request['activityType_code'];
        $activity->save();
        return $activity;
    }
    public function adminDenied($request,$id){
        $activity = activity::where('id',$id)->get()->first();
        $activity->activityStatus_code = 3;
        $activity->staffComment = $request['staffComment'];
        $activity->hasFood = $request['hasFood'];
        $activity->activityType_code = $request['activityType_code'];
        $activity->save();
        return $activity;
    }
    public function getPending(){
        $pending = activity::where('activityStatus_code', 1)->count('activityStatus_code');
        return $pending;
    }

    public function getApproved(){
        $approved = activity::where('activityStatus_code', 2)->count('activityStatus_code');
        return $approved;
    }

    public function getDenied(){
        $denied = activity::where('activityStatus_code', 3)->count('activityStatus_code');
        return $denied;
    }

    public function getTypes(){
        return activityType::all();
    }
}