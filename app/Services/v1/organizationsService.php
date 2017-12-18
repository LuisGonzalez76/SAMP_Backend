<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/12/17
 * Time: 9:36 PM
 */

namespace App\Services\v1;

use App\Http\Requests\Request;
use DB;
use App\organization;
use App\counsel;
use App\counselor;
use App\organizationType;


class organizationsService
{

    public function getOrganizations(){

        $organizations = DB::select('select o.id, o.organizationName,ot.description,o.organizationInitials,o.created_at,
        c.fullName,c.counselorEmail,c.counselorPhone,c.counselorFaculty,c.counselorDepartment,c.counselorOffice
        from organization_types as ot,counselors as c, counsels as cn,organizations as o
        where cn.counselor_id = c.id and cn.organization_id = o.id and ot.code = o.organizationType_code'
        );

        return $organizations;


    }

    public function storeOrganization($request){

        $organization = new organization;
        $organization = $request->all();

        $organization_json = organization::create([
            'organizationName' => $request['organizationName'],
            'organizationInitials'  => $request['organizationInitials'],
//            'organizationType_code' => $request['organizationType_code'],
            'organizationType_code' => $request['organizationType_code'],
            'organizationStatus_code' => $request['organizationStatus_code'],

        ]);

        $counselor =  new counselor;
        $counselor = $request->all();
        $counselor_json = counselor::create([
            'fullName' => $request['fullName'],
            'counselorEmail' => $request['counselorEmail'],
            'counselorPhone' => $request['counselorPhone'],
            'counselorFaculty' => $request['counselorFaculty'],
            'counselorDepartment' => $request['counselorDepartment'],
            'counselorOffice' => $request['counselorOffice'],

        ]);

        echo $request;

        $o_id = json_decode($organization_json);
        $c_id = json_decode($counselor_json);

        $counsels =  new counsel;
        return counsel::create([
            'counselor_id' => $c_id->id,
            'organization_id'  => $o_id->id,

        ]);

    }

    public function showOrganization($id){

        $organization = DB::table('counsels')
                        ->join('counselors','counsels.counselor_id','=','counselors.id')
                        ->join('organizations','counsels.organization_id','=','organizations.id')
                        ->join('organization_types','organizations.organizationType_code','=','organization_types.code')
                        ->select('organizations.id','organizations.organizationName','organization_types.description',
                            'organizations.organizationInitials','organizations.created_at','counselors.fullName',
                            'counselors.counselorEmail','counselors.counselorPhone','counselors.counselorFaculty',
                            'counselors.counselorDepartment','counselors.counselorOffice')
                        ->where('organizations.id', $id)
                        ->get();
        return $organization;

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


}