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





class facilitiesService
{

    public function getFacilities(){

        $facilities = DB::table('managements')
                      ->join('facilities_managers', 'managements.manager_id', '=', 'facilities_managers.id')
                      ->join('facilities', 'managements.facility_id', '=', 'facilities.id')
                      ->select('facilities.id','facilities.space','facilities.building','facilities.created_at','facilities_managers.fullName','facilities_managers.managerEmail')
                      ->get();

        return $facilities;


    }

    public function storeFacilities( $request){

        $facility = new facility;
        $facility = $request->all();

         $facility_json= facility::create([
            'building' => $request['building'],
            'space' => $request['space'],
            'facilityDepartment_code' => $request['facilityDepartment_code'],


        ]);

         $facility_manager =  new facilitiesManager;
         $facility_manager = $request->all();
         $facility_manager_json= facilitiesManager::create([
             'fullName' => $request['fullName'],
             'managerEmail' => $request['managerEmail'],
             'managerPhone' => $request['managerPhone'],

         ]);

         $f_id = json_decode($facility_json);
         $m_id = json_decode($facility_manager_json);

         $manages =  new management;
         return management::create([
             'facility_id' => $f_id->id,
             'manager_id'  => $m_id->id,

         ]);


    }


    public function showFacility ($id){

      // return $facility = facility::find($id);
        $facilities = DB::table('managements')
            ->join('facilities_managers', 'managements.manager_id', '=', 'facilities_managers.id')
            ->join('facilities', 'managements.facility_id', '=', 'facilities.id')
            ->select('facilities.id','facilities.space','facilities.building','facilities.created_at','facilities_managers.fullName','facilities_managers.managerEmail')
            ->where('facilities.id','=',$id)
            ->get();

        return $facilities;


    }

}