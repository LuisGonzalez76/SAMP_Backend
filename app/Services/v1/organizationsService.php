<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/12/17
 * Time: 9:36 PM
 */

namespace App\Services\v1;

use App\activity;
use App\Http\Requests\Request;
use App\student;
use App\membership;
use App\organizationRole;
use DB;
use App\organization;
use App\counsel;
use App\counselor;
use App\organizationType;
use function MongoDB\BSON\fromJSON;
use function MongoDB\BSON\toJSON;

class organizationsService
{

    public function getOrganizationsByUser($email){
        $student = student::where('studentEmail',$email)->with('organizations.counselors')->get()->first();

        $s_json = json_decode($student);
        $orgs = $s_json->organizations;
        $numberofOrgs =  sizeof($orgs);
        $orgsWithCounselor = [];
        for($i=0;$i<$numberofOrgs;$i++){
            $aa = $orgs[$i];
            if(sizeof($aa->counselors)>0){
                $orgsWithCounselor [] = $orgs[$i];
            }
        }
        return $orgsWithCounselor;

    }

    public function getOrganizations(){
        $organizations = organization::with('counselors')->with('members')->get();
       return $organizations;
}

    public function storeOrganization2($request)
    {
        $organization_json = organization::create([
            'organizationName' => $request['organizationName'],
            'organizationInitials' => $request['organizationInitials'],
            'organizationType_code' => $request['organizationType_code'],
            'organizationStatus_code' => $request['organizationStatus_code'],
            'url' => $request['url'],

        ]);

        return $organization_json;
    }


    public function storeOrganization($request){

        if ($request != null) {

            $organization = new organization;
            $organization = $request->all();

            $counselor = new counselor;
            $counselor = $request->all();


            if ($this->hasOrganization($request) and $this->hasCounselor($request)) {

                $organizations = DB::table('organizations')
                    ->where('organizationName', $request['organizationName'])
                    ->where('organizationInitials', $request['organizationInitials'])
                    ->where('organizationType_code', $request['organizationType_code'])
                    ->where('organizationStatus_code', $request['organizationStatus_code'])
                    ->value('id');

                $counselor = DB::table('counselors')
                    ->where('fullName', $request['fullName'])
                    ->where('counselorEmail', $request['counselorEmail'])
                    ->where('counselorPhone', $request['counselorPhone'])
                    ->where('counselorFaculty', $request['counselorFaculty'])
                    ->where('counselorDepartment', $request['counselorDepartment'])
                    ->where('counselorOffice', $request['counselorOffice'])
                    ->value('id');

                $counsels = new counsel;
                return counsel::create([
                    'counselor_id' => $counselor,
                    'organization_id' => $organizations,

                ]);

            } else if ($this->hasOrganization($request) and !$this->hasCounselor($request)) {

                $organizations = DB::table('organizations')
                    ->where('organizationName', $request['organizationName'])
                    ->where('organizationInitials', $request['organizationInitials'])
                    ->where('organizationType_code', $request['organizationType_code'])
                    ->where('organizationStatus_code', $request['organizationStatus_code'])
                    ->value('id');

                $counselor_json = counselor::create([
                    'fullName' => $request['fullName'],
                    'counselorEmail' => $request['counselorEmail'],
                    'counselorPhone' => $request['counselorPhone'],
                    'counselorFaculty' => $request['counselorFaculty'],
                    'counselorDepartment' => $request['counselorDepartment'],
                    'counselorOffice' => $request['counselorOffice'],

                ]);

                $c_id = json_decode($counselor_json);

                $counsels = new counsel;
                return counsel::create([
                    'counselor_id' => $c_id->id,
                    'organization_id' => $organizations,

                ]);

            } else if (!$this->hasOrganization($request) and $this->hasCounselor($request)) {

                $organization_json = organization::create([
                    'organizationName' => $request['organizationName'],
                    'organizationInitials' => $request['organizationInitials'],
                    'organizationType_code' => $request['organizationType_code'],
                    'organizationStatus_code' => $request['organizationStatus_code'],
                    'url' => $request['url'],

                ]);

                $o_id = json_decode($organization_json);

                $counselor = DB::table('counselors')
                    ->where('fullName', $request['fullName'])
                    ->where('counselorEmail', $request['counselorEmail'])
                    ->where('counselorPhone', $request['counselorPhone'])
                    ->where('counselorFaculty', $request['counselorFaculty'])
                    ->where('counselorDepartment', $request['counselorDepartment'])
                    ->where('counselorOffice', $request['counselorOffice'])
                    ->value('id');

                $counsels = new counsel;
                return counsel::create([
                    'counselor_id' => $counselor,
                    'organization_id' => $o_id->id,
                ]);


            } else {

                $organization_json = organization::create([
                    'organizationName' => $request['organizationName'],
                    'organizationInitials' => $request['organizationInitials'],
                    'organizationType_code' => $request['organizationType_code'],
                    'organizationStatus_code' => $request['organizationStatus_code'],
                    'url' => $request['url'],

                ]);

                $counselor_json = counselor::create([
                    'fullName' => $request['fullName'],
                    'counselorEmail' => $request['counselorEmail'],
                    'counselorPhone' => $request['counselorPhone'],
                    'counselorFaculty' => $request['counselorFaculty'],
                    'counselorDepartment' => $request['counselorDepartment'],
                    'counselorOffice' => $request['counselorOffice'],

                ]);

                $o_id = json_decode($organization_json);
                $c_id = json_decode($counselor_json);

                $counsels = new counsel;
                return counsel::create([
                    'organization_id' => $o_id->id,
                    'counselor_id' => $c_id->id,
                ]);


            }


            /*$counsels =  new counsel;
            return counsel::create([
                'counselor_id' => $c_id->id,
                'organization_id'  => $o_id->id,

            ]);*/
        }

        else {

            return response() -> json(['message' => 'No data is present in request!'], 200);

        }

    }

    public function createOrganization($request){
        if ($request != null) {

            if($this->hasOrganization($request)){

                return response() -> json(['message' => 'Organization already exists'], 200);

            }

            else{


                $organization = organization::create([
                    'organizationName' => $request['organizationName'],
                    'organizationInitials' => $request['organizationInitials'],
                    'organizationType_code' => $request['organizationType_code'],
                    'url' => $request['url'],
                    'isActive' => 1,

                ]);

                return $organization;

            }


        }

        else{

            return response() -> json(['message' => 'No data is present in request!'], 200);

        }

    }

    public function hasOrganization($request){

      $organizations = DB::table('organizations')
                        ->where('organizationName',$request['organizationName'])
                        ->where('organizationInitials',$request['organizationInitials'])
                        //->where('organizationType_code',$request['organizationType_code'])
                        //->where('isActive',$request['isActive'])
                        ->get();

      if(count($organizations) > 0){
          return true;
      }

      else{
          return false;
      }


    }

    public function hasCounselor($request){

        $counselor = DB::table('counselors')
                    ->where('fullName', $request['fullName'])
                    ->where('counselorEmail',$request['counselorEmail'])
                    ->where('counselorPhone',$request['counselorPhone'])
                    ->where('counselorFaculty', $request['counselorFaculty'])
                    ->where('counselorDepartment', $request['counselorDepartment'])
                    ->where('counselorOffice',$request['counselorOffice'])
                    ->get();

        if(count($counselor) > 0){
            return true;
        }

        else{
            return false;
        }


    }

    public function showOrganization($id){
        return organization::where('id',$id)->get();
    }

    public function updateOrganization($request,$id){
        $organization = organization::where('id',$id)->get()->first();
        $organization->organizationName = $request->input('organizationName');
        $organization->organizationInitials = $request->input('organizationInitials');
        $organization->organizationTYpe_code = $request->input('organizationType_code');
        $organization->url = $request->input('url');

        $organization->save();

        return $organization;
    }

    public function hasCounselorEmail($request,$id){


        $email = counselor::where('counselorEmail',$request['counselorEmail'])
            ->get();

       if(count($email) > 0){
            return true;
        }

        else{
            return false;
        }

    }

    public function hasOrganizationName($request,$id){



        $organizations = organization::where('organizationName',$request['organizationName'])
            ->where('organizationInitials',$request['organizationInitials'])
            ->get();

        /*$organizations = DB::table('organizations')
            //->where('organizationName',$request['organizationName'])
            ->where('organizationInitials',$request['organizationInitials'])
            ->get();*/



        if(count($organizations) > 0){
            return true;
        }

        else{
            return false;
        }



    }


    public function getOrganizationTypes(){

        $organization_types = organizationType::all();
        return $organization_types;

    }

    public function showOrganizationType($code){
        $organization_type = organizationType::where('code',$code)
                            ->get();
        return $organization_type;
    }

    public function postOrganizationType($request){
        $organization_type = new organizationType;
        $organization_type->description = $request->description;
        $organization_type->save();

    }

    public function putOrganizationType($request,$code){
        $organization_type = organizationType::where('code',$code)
                            ->update(['description' => $request['description']]);

    }

    public function getOrganizationRoles(){
        $organization_roles = organizationRole::all();
        return $organization_roles;

    }

    public function addCounselor($oid,$cid){

        $counsels = counsel::create([
            'counselor_id' => $cid,
            'organization_id' => $oid,
        ]);

    }

    public function addMember($oid,$sid,$rid){

        $member = membership::create([
            'student_id' => $sid,
            'organization_id' => $oid,
            'organizationRole_code' => $rid,
        ]);
    }


    public function getOrganizationMembers($id){

        $members = DB::select('select s.id,s.studentName,s.studentEmail, oo.description, s.studentNo, s.studentPhone, s.studentAddress, s.studentCity, s.studentCountry, s.studentZipCode
        from organizations as o, students as s , organization_roles as oo, memberships as m 
        where m.organization_id = o.id and m.student_id = s.id and m.organizationRole_code = oo.code and o.id = ?',[$id]);

        return $members;

    }

    public function removeOrganizationMember($sid,$oid){

        $members = membership::where('student_id',$sid)
                            ->where('organization_id',$oid)
                            ->delete();


    }

    public function getOrganizationCounselors($id){

        $counselors = DB::select('select c.id,c.counselorName,c.counselorEmail,c.counselorPhone,c.counselorFaculty,c.counselorDepartment,c.counselorOffice
        from counselors as c, counsels as co, organizations as o
        where co.counselor_id = c.id and co.organization_id = o.id and o.id = ?',[$id]);

        return $counselors;

    }

    public function removeOrganizationCounselor($cid,$oid){

        $members = counsel::where('counselor_id',$cid)
            ->where('organization_id',$oid)
            ->delete();


    }

    public function getOrganizationActivities($id){
        $activities = DB::table('activities')
                    ->join('organizations','activities.organization_id','=','organizations.id')
                    ->join('facilities','activities.facility_id','=','facilities.id')
                    ->join('activity_statuses','activities.activityStatus_code','=','activity_statuses.code')
                    ->select('activities.id','activities.activityName','activities.activityDescription','organizations.organizationName',
                        'facilities.building','facilities.space','activity_statuses.description')
                    ->where('organizations.id',$id)
                    ->get();
        return $activities;
}

    public function organizationsWithCounselors(){
        $orgs =  organization::has('counselors')->with('counselors')->get();
        return $orgs;

    }





}