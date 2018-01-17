<?php
namespace App\Services\v1;

use App\activityType;
use App\management;
use App\Providers\v1\studentServiceProvider;
use App\student;
use App\activity;
use App\counselor;
use App\organization;
use App\facility;
use App\facilitiesManager;
use App\user;
use DB;

class activityService{
    public function getActivities(){
        //$temp = activity::orderBy('activityStatus_code')->get();
        //return $temp;

        $activity  = activity::with('student','organization.counselors',
            'facility.managers','status','counselor_status',
            'manager_status','type')->get();
        return $activity;
    }

    public function getActivity($id){
        return activity::where('id','=',$id)->with('student')->with('staff')->with('organization.counselors')
            ->with('facility.managers')->with('status','type')
            ->with('counselor_status')->with('manager_status')
            ->get()->first();
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

            if($this->staffManages($request['facility_id'])){
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
                    'activityStart'=>$start,
                    'activityEnd'=>$end,
                    'hasFood'=>$request['hasFood'],
                    'guestName'=>$request['guestName'],
                    'activityStatus_code'=>1,
                    'counselorStatus_code'=>1,
                    'managerStatus_code'=>2,
                    'activityType_code'=>$request['activityType_code'],
                    'counselorComment'=>$request['counselorComment'],
                    'managerComment'=>$request['managerComment'],
                    'staffComment'=>$request['staffComment'],
                ]);
                return $activity;
            }

            else{
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
                    'activityStart'=>$start,
                    'activityEnd'=>$end,
                    'hasFood'=>$request['hasFood'],
                    'guestName'=>$request['guestName'],
                    'activityStatus_code'=>1,
                    'counselorStatus_code'=>1,
                    'managerStatus_code'=>1,
                    'activityType_code'=>$request['activityType_code'],
                    'counselorComment'=>$request['counselorComment'],
                    'managerComment'=>$request['managerComment'],
                    'staffComment'=>$request['staffComment'],
                ]);
                return $activity;
            }

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
        $activity->managerStatus_code = 3;
        $activity->activityStatus_code = 3;
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
        $activity->activityStatus_code = 3;
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

    public function changeType($request,$id){
        $activity = activity::where('id',$id)->get()->first();
        $activity->activityType_code = $request['activityType_code'];
        $activity->save();
    }
    public function getPending(){
        $pending = DB::select('select count(*) as pending
                            from activities
                            where activityStatus_code = 1 and counselorStatus_code != 3 and managerStatus_code != 3');
        return $pending;
    }

    public function getApproved(){
        $approved = DB::select('select count(*) as approved
                            from activities
                            where activityStatus_code = 2 and counselorStatus_code = 2 and managerStatus_code = 2');
        return $approved;
    }

    public function getDenied(){

        $denied = DB::select('select count(*) as Denied
                            from activities
                            where activityStatus_code = 3 or counselorStatus_code = 3 or managerStatus_code = 3 ');

        return $denied;
    }



    public function getTypes(){
        return activityType::all();
    }

    public function getReport($request){

        $startDate = (string) $request['startDate'];
        $endDate = (string) $request['endDate'];


        $report = DB::select('SELECT building,space, sum(CASE WHEN a.activityEnd > \'16:30:00\' and a.activityStart < \'16:30:00\' then 0.5  WHEN a.activityEnd < \'16:30:00\' then 1 ELSE 0 end)as Diurno, sum(CASE WHEN a.activityEnd > \'16:30:00\' and a.activityStart < \'16:30:00\' then 0.5  WHEN a.activityStart > \'16:30:00\' then 1 ELSE 0 end )as Nocturno, 
        sum(case when at.description = \'Academica\' then 1 else 0 end) as Academica,sum(case when at.description = \'Arte\' then 1 else 0 end) as Arte,sum(case when at.description = \'Civica\' then 1 else 0 end) as Civica,sum(case when at.description = \'Deportiva\' then 1 else 0 end) as Deportiva ,sum(case when at.description = \'Educativa\' then 1 else 0 end) as Educativa,
        sum(case when at.description = \'Profesional\' then 1 else 0 end) as Profesional ,sum(case when at.description = \'Venta\' then 1 else 0 end) as Venta ,sum(case when at.description = \'Religiosa\' then 1 else 0 end) as Religiosa ,sum(case when at.description = \'Social\' then 1 else 0 end) as Social ,sum(case when at.description = \'Politica\' then 1 else 0 end) as Politica,count(at.description)as Total  
        from facilities as f , activities as a , activity_types as at 
        where a.facility_id = f.id and a.activityType_code = at.code and a.activityStatus_code = 2 and a.counselorStatus_code = 2 and a.managerStatus_code = 2 and activityDate between ? and ? group by building,space',[$startDate,$endDate]);

        return $report;

    }

    public function getRequested(){

        $requested = DB::select('select building,space,sum(case when activityStatus_code = 1 then 1 when activityStatus_code = 2 then 1 when activityStatus_code = 3 then 1 else 0 end) as Requested
        from activities as a, facilities as f where a.facility_id = f.id
        group by building,space');

        return $requested;


    }

    public function getStatuses(){

        $statuses = DB::select('select building, space, activityName, ActivityDescription,CASE WHEN activityStatus_code = 1 then\'pending\' WHEN activityStatus_code = 2 then \'approved\' WHEN activityStatus_code =3 or counselorStatus_code =3 or managerStatus_code = 3 then \'denied\' else \'unclassified\' end as Status 
        from activities as a, facilities as f 
        where a.facility_id = f.id');

        return $statuses;


    }




    public function staffManages($id){
        $temp = management::where('facility_id',$id)->get()->first();
        $manager = facilitiesManager::where('id',$temp->manager_id)->get()->first();
        $user = user::where('id',$manager->user_id)->get()->first();
        return ($user->userType_code==1)||($user->userType_code==2);
    }

    public function storeByAdmin($request){
        if($request!=null){

            if($this->staffManages($request['facility_id'])){
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
                    'activityStart'=>$start,
                    'activityEnd'=>$end,
                    'hasFood'=>$request['hasFood'],
                    'guestName'=>$request['guestName'],
                    'activityStatus_code'=>2,
                    'counselorStatus_code'=>2,
                    'managerStatus_code'=>2,
                    'activityType_code'=>$request['activityType_code'],
                    'counselorComment'=>$request['counselorComment'],
                    'managerComment'=>$request['managerComment'],
                    'staffComment'=>$request['staffComment'],
                ]);
                return $activity;
            }

            else{
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
                    'activityStart'=>$start,
                    'activityEnd'=>$end,
                    'hasFood'=>$request['hasFood'],
                    'guestName'=>$request['guestName'],
                    'activityStatus_code'=>1,
                    'counselorStatus_code'=>2,
                    'managerStatus_code'=>1,
                    'activityType_code'=>$request['activityType_code'],
                    'counselorComment'=>$request['counselorComment'],
                    'managerComment'=>$request['managerComment'],
                    'staffComment'=>$request['staffComment'],
                ]);
                return $activity;
            }

        }
        else {
            return response() -> json(['message' => 'No data is present in request!'], 200);
        }
    }


    public function activityByOrg($id){
        return activity::where('organization_id',$id)->with('student','organization',
            'facility','status','counselor_status','manager_status')->get();
    }

    public function activityByFacility($id){
        return activity::where('facility_id',$id)->with('student','organization',
            'facility','status','counselor_status','manager_status')->get();
    }


}