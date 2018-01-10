<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/12/17
 * Time: 5:32 PM
 */

namespace App\Services\v1;

use App\Http\Requests\Request;

use DB;
use App\facility;
use App\facilitiesManager;
use App\management;
use App\facilityDepartment;
use function MongoDB\BSON\fromJSON;


class facilitiesService
{

    public function getFacilities(){
        $facilities = facility::all();
        return $facilities;
    }



    public function createFacilities($request){

        if ($request != null) {

            $facilities = facility::create([
                'building' => $request['building'],
                'space' => $request['space'],
                'facilityDepartment' => $request['facilityDepartment'],
                'isActive' => 1,
            ]);

            return $facilities;

        }

        else{
            return response() -> json(['message' => 'No data is present in request!'], 200);
        }

    }

    public function showFacility ($id){
        $facilities = facility::find($id);
        return $facilities;
    }

    public function updateFacility($request,$id){
        $facility = facility::where('id',$id)->get()->first();


        $facility->building = $request->input('building');
        $facility->space = $request->input('space');
        $facility->facilityDepartment = $request->input('facilityDepartment');

        $facility->save();
    }

    public function addManager($fid,$mid){

        $manages = management::create([
            'facility_id' => $fid,
            'manager_id' => $mid,
        ]);

    }

    public function managedByStaff($id){

    }

}