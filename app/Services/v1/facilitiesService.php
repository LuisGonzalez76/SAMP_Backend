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

        /*$facilities = DB::table('managements')
                      ->join('facilities_managers', 'managements.manager_id', '=', 'facilities_managers.id')
                      ->join('facilities', 'managements.facility_id', '=', 'facilities.id')
                      ->select('facilities.id','facilities.space','facilities.building','facilities.created_at','facilities_managers.fullName','facilities_managers.managerEmail')
                      ->get();*/

        $facilities = DB::table('managements')
            ->join('facilities_managers', 'managements.manager_id', '=', 'facilities_managers.id')
            ->join('facilities', 'managements.facility_id', '=', 'facilities.id')
            ->select('managements.id','facilities.space','facilities.building','facilities.created_at','facilities_managers.fullName','facilities_managers.managerEmail')
            ->get();

        return $facilities;


    }

    public function storeFacilities( $request)
    {


        if ($request != null) {




            $facility = new facility;
            $facility = $request->all();
            //$f_id =null;
            //$m_id =null;

           /* $facility_json = facility::create([
                'building' => $request['building'],
                'space' => $request['space'],
                'facilityDepartment_code' => $request['facilityDepartment_code'],


            ]);
            */


            $facility_manager = new facilitiesManager;
            $facility_manager = $request->all();
            /*$facility_manager_json = facilitiesManager::create([
                'fullName' => $request['fullName'],
                'managerEmail' => $request['managerEmail'],
                'managerPhone' => $request['managerPhone'],

            ]);*/

            if ( $this->hasFacility($request) and $this->hasManager($request)){

                $facilities_json = DB::table('facilities')
                    ->where('building',$request['building'])
                    ->where ('space',$request['space'])
                    ->where('facilityDepartment_code',$request['facilityDepartment_code'])
                    ->value('id');

                //$f_id = json_encode($facilities_json);

                $managers_json =  DB::table('facilities_managers')

                    ->where('fullName',$request['fullName'])
                    ->where('managerEmail',$request['managerEmail'])
                    ->where('managerPhone',$request['managerPhone'])
                    ->value('id');

                //echo $managers_json;

                //return $managers_json;

                //$m_id = json_encode($managers_json);


                $manages = new management;
                return management::create([
                    'facility_id' => $facilities_json,
                    'manager_id' => $managers_json,

                ]);

            }

            else if ( $this->hasFacility($request) and !$this->hasManager($request)){

                $facilities_json = DB::table('facilities')
                    ->where('building',$request['building'])
                    ->where ('space',$request['space'])
                    ->where('facilityDepartment_code',$request['facilityDepartment_code'])
                    ->value('id');

                $manager_json = facilitiesManager::create([
                    'fullName' => $request['fullName'],
                    'managerEmail' => $request['managerEmail'],
                    'managerPhone' => $request['managerPhone'],
                ]);

                $m_id = json_decode($manager_json);

                $manages = new management;
                return management::create([
                    'facility_id' => $facilities_json,
                    'manager_id' => $m_id->id,

                ]);


            }

            else if (!$this->hasFacility($request) and $this->hasManager($request)){

                $facilities_json = facility::create([
                    'building' => $request['building'],
                    'space' => $request['space'],
                    'facilityDepartment_code' => $request['facilityDepartment_code'],


                ]);

                $f_id = json_decode($facilities_json);

                $managers_json =  DB::table('facilities_managers')

                    ->where('fullName',$request['fullName'])
                    ->where('managerEmail',$request['managerEmail'])
                    ->where('managerPhone',$request['managerPhone'])
                    ->value('id');


                $manages = new management;
                return management::create([
                    'facility_id' => $f_id->id,
                    'manager_id' => $managers_json,

                ]);

            }

            else{

                $facilities_json = facility::create([
                    'building' => $request['building'],
                    'space' => $request['space'],
                    'facilityDepartment_code' => $request['facilityDepartment_code'],
                ]);

                $f_id = json_decode($facilities_json);


                $manager_json = facilitiesManager::create([
                    'fullName' => $request['fullName'],
                    'managerEmail' => $request['managerEmail'],
                    'managerPhone' => $request['managerPhone'],
                ]);

                $m_id = json_decode($manager_json);

                $manages = new management;
                return management::create([
                    'facility_id' => $f_id->id,
                    'manager_id' => $m_id->id,

                ]);

            }




            /*$f_id = json_decode($facility_json);
            $m_id = json_decode($facility_manager_json);*/

            /*$manages = new management;
            return management::create([
                'facility_id' => $f_id->id,
                'manager_id' => $m_id->id,

            ]);*/


        }

        else {

            return response() -> json(['message' => 'No data is present in request!'], 200);

        }

    }

    public function hasFacility($request){

        $facilities = DB::table('facilities')
                    ->where('building',$request['building'])
                    ->where ('space',$request['space'])
                    ->where('facilityDepartment_code',$request['facilityDepartment_code'])
                    ->get();

        if(count($facilities) > 0){
            return true;
        }

        else{

            return false;
        }


    }

    public function hasManager($request){
        $managers =  DB::table('facilities_managers')
                    ->where('fullName',$request['fullName'])
                    ->where('managerEmail',$request['managerEmail'])
                    ->where('managerPhone',$request['managerPhone'])
                    ->get();

        if(count($managers) > 0)
        {
            return true;
        }

        else{
            return false;
        }
    }


    public function showFacility ($id){

      // return $facility = facility::find($id);
        /*$facilities = DB::table('managements')
            ->join('facilities_managers', 'managements.manager_id', '=', 'facilities_managers.id')
            ->join('facilities', 'managements.facility_id', '=', 'facilities.id')
            ->select('facilities.id','facilities.space','facilities.building','facilities.created_at','facilities_managers.fullName','facilities_managers.managerEmail')
            ->where('facilities.id','=',$id)
            ->get();*/

        $facilities = DB::table('managements')
            ->join('facilities_managers', 'managements.manager_id', '=', 'facilities_managers.id')
            ->join('facilities', 'managements.facility_id', '=', 'facilities.id')
            ->select('managements.id','facilities.space','facilities.building','facilities.created_at','facilities_managers.fullName','facilities_managers.managerEmail')
            ->where('managements.id','=',$id)
            ->get();

        return $facilities;


    }


    public function getDepartments(){

        $departments = facilityDepartment::all();
        return $departments;

    }

    public function showDepartment($code){
        $department = facilityDepartment::where('code',$code)
                    ->get();
        return $department;

    }

    public function postDepartment($request){
        $department = new facilityDepartment;
        $department->description = $request->description;
        $department->save();

    }

    public function putDepartment($request, $code){
        $department = facilityDepartment::where('code',$code)
                    ->update(['description' => $request['description']]);

    }

    public function updateFacility($request,$id){

        $manager_id = management::where('id',$id)->value('manager_id');
        $facility_id = management::where('id',$id)->value('facility_id');

        if ( $this->hasFacilityName($request) and $this->hasManagerEmail($request)){

            return true;
        }

        else{
            return false;
        }



    }

    public function hasManagerEmail($request){

        $email = facilitiesManager::where('managerEmail',$request['managerEmail'])
                                    ->get();

        if(count($email) > 0){
            return true;
        }

        else {
            return false;
        }


    }

    public function hasFacilityName($request){

        $facility = facility::where('building','like', '%' .$request['building'] . '%' )
                            ->where('space','like', '%' .$request['space']. '%')
                            ->get();

        if(count($facility) > 0){
            return true;
        }

        else{
            return false;
        }

    }


    

}