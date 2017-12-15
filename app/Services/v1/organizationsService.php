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

}