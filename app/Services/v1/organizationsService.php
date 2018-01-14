<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/12/17
 * Time: 9:36 PM
 */

namespace App\Services\v1;

use App\Http\Requests\Request;
use App\student;
use DB;
use App\organization;
use App\counsel;
use App\counselor;
use App\organizationType;
use function MongoDB\BSON\fromJSON;

class organizationsService
{

    public function getOrganizationsByUser($email){
        $student = student::where('studentEmail',$email)->with('organizations.counselors')->get()->first();

        $s_json = json_decode($student);
        $orgs = $s_json->organizations;
        return $orgs;
    }

    public function getOrganizations(){

        /*$organizations = DB::select('select o.id, o.organizationName,ot.description,o.organizationInitials,o.created_at,
        c.fullName,c.counselorEmail,c.counselorPhone,c.counselorFaculty,c.counselorDepartment,c.counselorOffice
        from organization_types as ot,counselors as c, counsels as cn,organizations as o
        where cn.counselor_id = c.id and cn.organization_id = o.id and ot.code = o.organizationType_code'
        );*/

       $organizations = organization::with('counselors')->get();

       /* $organizations = DB::select('select cn.id, o.organizationName,ot.description,o.organizationInitials,o.created_at,
        c.fullName,c.counselorEmail,c.counselorPhone,c.counselorFaculty,c.counselorDepartment,c.counselorOffice
        from organization_types as ot,counselors as c, counsels as cn,organizations as o
        where cn.counselor_id = c.id and cn.organization_id = o.id and ot.code = o.organizationType_code'
        );*/


        return $organizations;


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

        /*$organization = DB::table('counsels')
                        ->join('counselors','counsels.counselor_id','=','counselors.id')
                        ->join('organizations','counsels.organization_id','=','organizations.id')
                        ->join('organization_types','organizations.organizationType_code','=','organization_types.code')
                        ->select('organizations.id','organizations.organizationName','organization_types.description',
                            'organizations.organizationInitials','organizations.created_at','counselors.fullName',
                            'counselors.counselorEmail','counselors.counselorPhone','counselors.counselorFaculty',
                            'counselors.counselorDepartment','counselors.counselorOffice')
                        ->where('organizations.id', $id)
                        ->get();*/


        /*$organization = DB::table('counsels')
            ->join('counselors','counsels.counselor_id','=','counselors.id')
            ->join('organizations','counsels.organization_id','=','organizations.id')
            ->join('organization_types','organizations.organizationType_code','=','organization_types.code')
            ->select('counsels.id','organizations.organizationName','organization_types.description',
                'organizations.organizationInitials','organizations.created_at','counselors.counselorName',
                'counselors.counselorEmail','counselors.counselorPhone','counselors.counselorFaculty',
                'counselors.counselorDepartment','counselors.counselorOffice')
            ->where('counsels.id', $id)
            ->get();*/

        $organization = DB::table('organizations')
                        ->join('organization_types','organizations.organizationType_code','=','organization_types.code')
                        ->select('organizations.id','organizations.organizationName','organizations.organizationInitials',
                            'organization_types.description','organizations.isActive')
                        ->where('organizations.id',$id)
                        ->get();

        return $organization;

    }

    //NO borrar
    /*public function updateOrganization($request,$id){


        $counselor_id = counsel::where('id',$id)->value('counselor_id');
        $organization_id = counsel::where('id',$id)->value('organization_id');

        $counselor_email = counselor::where('id',$counselor_id)
            ->value('counselorEmail');

        $organization_initials = organization::where('id',$organization_id)
            ->value('organizationInitials');

        $organization_name = organization::where('id',$organization_id)
            ->value('organizationName');

        if ($this->hasOrganizationName($request,$organization_id)  and $this->hasCounselorEmail($request,$counselor_id)){



            if ( ($counselor_email == $request['counselorEmail']) and ($organization_initials == $request['organizationInitials'])
            and ($organization_name == $request['organizationName'])){

                $organization = organization::where('id',$organization_id)->first();
                $organization->organizationName = $request->organizationName;
                $organization->organizationInitials = $request->organizationInitials;
                $organization->organizationType_code = $request->organizationType_code;
                $organization->organizationStatus_code = $request->organizationStatus_code;
                $organization->save();


                $counselor = counselor::where('id',$counselor_id)->first();
                $counselor->fullName = $request->fullName;
                $counselor->counselorEmail = $request->counselorEmail;
                $counselor->counselorPhone = $request->counselorPhone;
                $counselor->counselorFaculty = $request->counselorFaculty;
                $counselor->counselorDepartment = $request->counselorDepartment;
                $counselor->counselorOffice = $request->counselorOffice;
                $counselor->save();

            }

            else if (($counselor_email != $request['counselorEmail']) and ($organization_initials == $request['organizationInitials'])
            and ($organization_name == $request['organizationName'])){


                $organization = organization::where('id', $organization_id)->first();
                $organization->organizationName = $request->organizationName;
                $organization->organizationInitials = $request->organizationInitials;
                $organization->organizationType_code = $request->organizationType_code;
                $organization->organizationStatus_code = $request->organizationStatus_code;
                $organization->save();

                $counselor_id = counselor::where('counselorEmail', $request['counselorEmail'])
                    ->value('id');


                $counselor = counselor::where('id', $counselor_id)->first();
                $counselor->fullName = $request->fullName;
                $counselor->counselorEmail = $request->counselorEmail;
                $counselor->counselorPhone = $request->counselorPhone;
                $counselor->counselorFaculty = $request->counselorFaculty;
                $counselor->counselorDepartment = $request->counselorDepartment;
                $counselor->counselorOffice = $request->counselorOffice;
                $counselor->save();

                $counsels_update = counsel::where('id', $id)
                    ->update(['counselor_id' => $counselor_id]);

                return response()->json(['message' => 'Succesfully update data!'], 200);

            }

            else if (($counselor_email == $request['counselorEmail']) and ($organization_initials != $request['organizationInitials'])
            and ($organization_name != $request['organizationName'])){

                $organization_id = organization::where('organizationInitials',$request['organizationInitials'])
                                                ->where('organizationName', $request['organizationName'])
                                                ->value('id');

                $organization = organization::where('id', $organization_id)->first();
                $organization->organizationName = $request->organizationName;
                $organization->organizationInitials = $request->organizationInitials;
                $organization->organizationType_code = $request->organizationType_code;
                $organization->organizationStatus_code = $request->organizationStatus_code;
                $organization->save();

                $counsels_update = counsel::where('id',$id)
                    ->update(['organization_id' => $organization_id]);

                $counselor = counselor::where('id', $counselor_id)->first();
                $counselor->fullName = $request->fullName;
                $counselor->counselorEmail = $request->counselorEmail;
                $counselor->counselorPhone = $request->counselorPhone;
                $counselor->counselorFaculty = $request->counselorFaculty;
                $counselor->counselorDepartment = $request->counselorDepartment;
                $counselor->counselorOffice = $request->counselorOffice;
                $counselor->save();

            }

            else {

                $organization_id = organization::where('organizationInitials',$request['organizationInitials'])
                    ->value('id');

                $organization = organization::where('id', $organization_id)->first();
                $organization->organizationName = $request->organizationName;
                $organization->organizationInitials = $request->organizationInitials;
                $organization->organizationType_code = $request->organizationType_code;
                $organization->organizationStatus_code = $request->organizationStatus_code;
                $organization->save();

                $counselor_id = counselor::where('counselorEmail', $request['counselorEmail'])
                    ->value('id');


                $counselor = counselor::where('id', $counselor_id)->first();
                $counselor->fullName = $request->fullName;
                $counselor->counselorEmail = $request->counselorEmail;
                $counselor->counselorPhone = $request->counselorPhone;
                $counselor->counselorFaculty = $request->counselorFaculty;
                $counselor->counselorDepartment = $request->counselorDepartment;
                $counselor->counselorOffice = $request->counselorOffice;
                $counselor->save();

                $counsels_update = counsel::where('id',$id)
                    ->update(['organization_id' => $organization_id])
                    ->update(['counselor_id' => $counselor_id]);

            }

        }


        else if ( $this->hasOrganizationName($request,$organization_id)  and  !$this->hasCounselorEmail($request,$counselor_id)){

            if (($organization_initials == $request['organizationInitials'])) {

                $organization = organization::where('id', $organization_id)->first();
                $organization->organizationName = $request->organizationName;
                $organization->organizationInitials = $request->organizationInitials;
                $organization->organizationType_code = $request->organizationType_code;
                $organization->organizationStatus_code = $request->organizationStatus_code;
                $organization->save();

            }

            else {

                $organization_id = organization::where('organizationInitials',$request['organizationInitials'])
                                                ->where('organizationName', $request['organizationName'])
                                                ->value('id');

                $organization = organization::where('id', $organization_id)->first();
                $organization->organizationName = $request->organizationName;
                $organization->organizationInitials = $request->organizationInitials;
                $organization->organizationType_code = $request->organizationType_code;
                $organization->organizationStatus_code = $request->organizationStatus_code;
                $organization->save();

                $counsels_update = counsel::where('id',$id)
                    ->update(['organization_id' => $organization_id]);


            }

            $counselor_json = counselor::create([
                'fullName' => $request['fullName'],
                'counselorEmail' => $request['counselorEmail'],
                'counselorPhone' => $request['counselorPhone'],
                'counselorFaculty' => $request['counselorFaculty'],
                'counselorDepartment' => $request['counselorDepartment'],
                'counselorOffice' => $request['counselorOffice'],

            ]);

            $c_id = json_decode($counselor_json);

            $counsels_update = counsel::where('id',$id)
                ->update (['counselor_id' => $c_id->id]);

            return response() -> json(['message' => 'Succesfully update data!'], 200);

        }



        else if (!$this->hasOrganizationName($request,$organization_id) and $this->hasCounselorEmail($request,$counselor_id) ){

            if(($counselor_email == $request['counselorEmail'])) {

                $counselor = counselor::where('id', $counselor_id)->first();
                $counselor->fullName = $request->fullName;
                $counselor->counselorEmail = $request->counselorEmail;
                $counselor->counselorPhone = $request->counselorPhone;
                $counselor->counselorFaculty = $request->counselorFaculty;
                $counselor->counselorDepartment = $request->counselorDepartment;
                $counselor->counselorOffice = $request->counselorOffice;
                $counselor->save();
            }

            else{

                $counselor_id = counselor::where('counselorEmail', $request['counselorEmail'])
                    ->value('id');


                $counselor = counselor::where('id', $counselor_id)->first();
                $counselor->fullName = $request->fullName;
                $counselor->counselorEmail = $request->counselorEmail;
                $counselor->counselorPhone = $request->counselorPhone;
                $counselor->counselorFaculty = $request->counselorFaculty;
                $counselor->counselorDepartment = $request->counselorDepartment;
                $counselor->counselorOffice = $request->counselorOffice;
                $counselor->save();

                $counsels_update = counsel::where('id', $id)
                    ->update(['counselor_id' => $counselor_id]);
            }


            $organization_json = organization::create([
                'organizationName' => $request['organizationName'],
                'organizationInitials' => $request['organizationInitials'],
                'organizationType_code' => $request['organizationType_code'],
                'organizationStatus_code' => $request['organizationStatus_code'],

            ]);

            $o_id = json_decode($organization_json);

            $counsels_update = counsel::where('id',$id)
                ->update(['organization_id' => $o_id->id]);

            return response() -> json(['message' => 'Succesfully update data!'], 200);

        }

        else if (!$this->hasOrganizationName($request,$organization_id) and !$this->hasCounselorEmail($request,$counselor_id)){

            $organization_json = organization::create([
                'organizationName' => $request['organizationName'],
                'organizationInitials' => $request['organizationInitials'],
                'organizationType_code' => $request['organizationType_code'],
                'organizationStatus_code' => $request['organizationStatus_code'],

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

            return response() -> json(['message' => 'Succesfully update data!'], 200);

        }

        else{
            return "no funciona";
        }



    }*/

    public function updateOrganization($request,$id){
        $organization = organization::where('id',$id)->get()->first();
        $organization->organizationName = $request->input('organizationName');
        $organization->organizationInitials = $request->input('organizationInitials');
        $organization->organizationTYpe_code = $request->input('organizationType_code');

        $organization->save();


    }

    public function hasCounselorEmail($request,$id){


        $email = counselor::where('counselorEmail',$request['counselorEmail'])
            ->get();

        /*$email = DB::table('counselors')
            ->where('id',$id)
            ->where('counselorEmail',$request['counselorEmail'])
            ->get();*/


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

    public function addCounselor($cid,$oid){

        $counsels = counsel::create([
            'counselor_id' => $cid,
            'organization_id' => $oid,
        ]);


    }

}