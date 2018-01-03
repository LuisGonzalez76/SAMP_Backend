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

        $manager_email = facilitiesManager::where('id',$manager_id)
                        ->value('managerEmail');

        $building = facility::where('id',$facility_id)
                    ->value('building');

        $space = facility::where('id',$facility_id)
                ->value('space');

        if ( $this->hasFacilityName($request) and $this->hasManagerEmail($request)){


           if ( ($manager_email == $request['managerEmail']) and ($building == $request['building']) and ($space == $request['space'])) {

               $manager = facilitiesManager::where('id', $manager_id)->first();
               $manager->fullName = $request->fullName;
               $manager->managerEmail = $request->managerEmail;
               $manager->managerPhone = $request->managerPhone;
               $manager->save();


               $facility = facility::where('id', $facility_id)->first();
               $facility->building = $request->building;
               $facility->space = $request->space;
               $facility->facilityDepartment_code = $request->facilityDepartment_code;
               $facility->save();

           }

           else if ( ($manager_email != $request['managerEmail']) and ($building == $request['building']) and ($space == $request['space']) ){

               $manager_id = facilitiesManager::where('managerEmail',$request['managerEmail'])
                            ->value('id');

               $manager = facilitiesManager::where('id', $manager_id)->first();
               $manager->fullName = $request->fullName;
               $manager->managerEmail = $request->managerEmail;
               $manager->managerPhone = $request->managerPhone;
               $manager->save();

               $facility = facility::where('id', $facility_id)->first();
               $facility->building = $request->building;
               $facility->space = $request->space;
               $facility->facilityDepartment_code = $request->facilityDepartment_code;
               $facility->save();

               $managements_update = management::where('id',$id)
                                    ->update(['manager_id' => $manager_id]);


           }

           else if ( ($manager_email == $request['managerEmail']) and ($building != $request['building']) and ($space != $request['space']) ){

               $manager = facilitiesManager::where('id', $manager_id)->first();
               $manager->fullName = $request->fullName;
               $manager->managerEmail = $request->managerEmail;
               $manager->managerPhone = $request->managerPhone;
               $manager->save();

               $facility_id = facility::where('building',$request['building'])
                                        ->where('space', $request['space'])
                                        ->value('id');

               $facility = facility::where('id', $facility_id)->first();
               $facility->building = $request->building;
               $facility->space = $request->space;
               $facility->facilityDepartment_code = $request->facilityDepartment_code;
               $facility->save();

               $managements_update = management::where('id',$id)
                   ->update(['facility_id' => $facility_id]);

           }

           else{

               $manager_id = facilitiesManager::where('managerEmail',$request['managerEmail'])
                   ->value('id');

               $manager = facilitiesManager::where('id', $manager_id)->first();
               $manager->fullName = $request->fullName;
               $manager->managerEmail = $request->managerEmail;
               $manager->managerPhone = $request->managerPhone;
               $manager->save();

               $facility_id = facility::where('building',$request['building'])
                   ->where('space', $request['space'])
                   ->values('id');

               $facility = facility::where('id', $facility_id)->first();
               $facility->building = $request->building;
               $facility->space = $request->space;
               $facility->facilityDepartment_code = $request->facilityDepartment_code;
               $facility->save();

               $managements_update = management::where('id',$id)
                   ->update(['manager_id' => $manager_id])
                   ->update(['facility_id' => $facility_id]);

           }


        }

        else if ($this->hasFacilityName($request) and !$this->hasManagerEmail($request)){

            if (($building == $request['building']) and ($space == $request['space'])){

                $facility = facility::where('id', $facility_id)->first();
                $facility->building = $request->building;
                $facility->space = $request->space;
                $facility->facilityDepartment_code = $request->facilityDepartment_code;
                $facility->save();
            }

            else{

                $facility_id = facility::where('building',$request['building'])
                    ->where('space', $request['space'])
                    ->values('id');

                $facility = facility::where('id', $facility_id)->first();
                $facility->building = $request->building;
                $facility->space = $request->space;
                $facility->facilityDepartment_code = $request->facilityDepartment_code;
                $facility->save();

                $managements_update = management::where('id',$id)
                    ->update(['facility_id' => $facility_id]);

            }


            $manager_json = facilitiesManager::create([
                'fullName' => $request['fullName'],
                'managerEmail' => $request['managerEmail'],
                'managerPhone' => $request['managerPhone'],

            ]);

            $m_id = json_decode($manager_json);

            $managements_update = management::where('id',$id)
                                ->update(['manager_id' => $m_id->id]);


        }

        else if (!$this->hasFacilityName($request) and $this->hasManagerEmail($request)){

            if (($manager_email == $request['managerEmail'])){

                $manager = facilitiesManager::where('id', $manager_id)->first();
                $manager->fullName = $request->fullName;
                $manager->managerEmail = $request->managerEmail;
                $manager->managerPhone = $request->managerPhone;
                $manager->save();

            }

            else{

                $manager_id = facilitiesManager::where('managerEmail',$request['managerEmail'])
                    ->value('id');

                $manager = facilitiesManager::where('id', $manager_id)->first();
                $manager->fullName = $request->fullName;
                $manager->managerEmail = $request->managerEmail;
                $manager->managerPhone = $request->managerPhone;
                $manager->save();

                $managements_update = management::where('id',$id)
                    ->update(['manager_id' => $manager_id]);

            }

            $facility_json = facility::create([
                'building' => $request['building'],
                'space' => $request['space'],
                'facilityDepartment_code' => $request['facilityDepartment_code'],
            ]);

            $f_id = json_decode($facility_json);


            $managements_update = management::where('id',$id)
                ->update(['facility_id' => $f_id->id]);
        }



        else{

            $manager_json = facilitiesManager::create([
                'fullName' => $request['fullName'],
                'managerEmail' => $request['managerEmail'],
                'managerPhone' => $request['managerPhone'],

            ]);

            $facility_json = facility::create([
                'building' => $request['building'],
                'space' => $request['space'],
                'facilityDepartment_code' => $request['facilityDepartment_code'],
            ]);

            $m_id = json_decode($manager_json);
            $f_id = json_decode($facility_json);

            $managements = new management;
            return management::create([
                'manager_id' => $m_id->id,
                'facility_id' => $f_id->id,
            ]);


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