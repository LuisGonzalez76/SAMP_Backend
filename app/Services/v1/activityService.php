<?php
namespace App\Services\v1;

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
        //esto sirve para encontar el user sin saber el id
        // $activity = student::where('studentEmail','lg@upr.edu')->get()->first()->id;
        $activity  = activity::with('student')->with('organization.counselors')
            ->with('facility.managers', 'facility.department')
            ->get();
        return $activity;
    }

    public function getActivity($id){

        /*$activity = activity::where('id','=',$id)->with('student')->with('organization.counselors')
            ->with('facility.managers', 'facility.department')
            ->get();*/

        $activity = activity::where('id','=',$id)->with('student')->with('organization.counselors')
            ->with('facility.managers', 'facility.department')->with('status')
            ->with('counselor_status')->with('manager_status')
            ->get();
        return $activity;
    }

    public function getActivityByUser($email){
        $user = user::where('userEmail',$email)->get()->first();
        $u_json = json_decode($user);
        $type = $u_json->userType_code;

        if($type == 1){
            $admin = user::where('userEmail',$email)->with('staff','type')->get()->first();
            $decoded = json_decode($admin);
            //$u_id = $admin->;

        }
        if($type == 2){
            $staff =  user::where('userEmail',$email)->with('staff','type')->get()->first();
            $u_id = $staff->id;
        }
        if($type == 3){
            $student = user::where('userEmail',$email)->with('students','type')->get()->first();
            $decoded = json_decode($student);
            $u_id = $decoded->students[0]->id;
            return activity::where('student_id',$u_id)->get();
        }
        if($type == 4){
            $counselor = user::where('userEmail',$email)->with('counselors','type')->get()->first();
            $u_id = $counselor->id;
        }
        if($type == 5){
            $manager = user::where('userEmail',$email)->with('managers','type')->get()->first();
            $u_id = $manager->id;
        }
    }

    public function storeActivity($request){
        if($request!=null){
            $activity = activity::create([
                'student_id'=>$request['student_id'],
                'organization_id'=>$request['organization_id'],
                'facility_id'=>$request['facility_id'],
                'staff_id'=>$request['staff_id'],
                'activityName'=>$request['activityName'],
                'activityDescription'=>$request['activityDescription'],
                'attendantsNumber'=>$request['attendantsNumber'],
                'activityDate'=>$request['activityDate'],
                'activityStart'=>$request['activityStart'],
                'activityEnd'=>$request['activityEnd'],
                'hasFood'=>$request['hasFood'],
                'guestName'=>$request['guestName'],
                'activityStatus_code'=>$request['activityStatus_code'],
                'counselorStatus_code'=>$request['counselorStatus_code'],
                'managerStatus_code'=>$request['managerStatus_code'],
                'activityType_code'=>$request['activityType_code'],
                ]);
        }
        else {
            return response() -> json(['message' => 'No data is present in request!'], 200);
        }
    }

    public function counselorApproved($id){
        $activity = activity::where('id',$id)->get()->first();
        $activity->counselorStatus_code = 2;
        $activity->save();
    }
    public function counselorDenied($id){
        $activity = activity::where('id',$id)->get()->first();
        $activity->counselorStatus_code = 3;
        $activity->save();
    }

    public function managerApproved($id){
        $activity = activity::where('id',$id)->get()->first();
        $activity->managerStatus_code = 2;
        $activity->save();
    }
    public function managerDenied($id){
        $activity = activity::where('id',$id)->get()->first();
        $activity->managerStatus_code = 3;
        $activity->save();
    }

    public function adminApproved($id){
        $activity = activity::where('id',$id)->get()->first();
        $activity->activityStatus_code = 2;
        $activity->save();
    }
    public function adminDenied($id){
        $activity = activity::where('id',$id)->get()->first();
        $activity->activityStatus_code = 3;
        $activity->save();
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


}