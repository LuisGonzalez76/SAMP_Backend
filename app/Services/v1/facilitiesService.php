<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/12/17
 * Time: 5:32 PM
 */

namespace App\Services\v1;

use App\Http\Requests\Request;

use App\user;
use DB;
use App\facility;
use App\facilitiesManager;
use App\management;
use App\facilityDepartment;
use function MongoDB\BSON\fromJSON;


class facilitiesService
{

    public function getFacilities()
    {
        //$facilities = facility::all();
        $facilities = facility::with('managers')->get();
        return $facilities;
    }


    public function createFacilities($request)
    {

        if ($request != null) {

            $facilities = facility::create([
                'building' => $request['building'],
                'space' => $request['space'],
                'facilityDepartment' => $request['facilityDepartment'],
                'isActive' => 1,
            ]);

            return $facilities;

        } else {
            return response()->json(['message' => 'No data is present in request!'], 200);
        }

    }

    public function showFacility($id)
    {
        $facilities = facility::find($id);
        return $facilities;
    }

    public function updateFacility($request, $id)
    {
        $facility = facility::where('id', $id)->get()->first();


        $facility->building = $request->input('building');
        $facility->space = $request->input('space');
        $facility->facilityDepartment = $request->input('facilityDepartment');

        $facility->save();
    }

    public function addManager($fid, $mid)
    {

        $manages = management::create([
            'facility_id' => $fid,
            'manager_id' => $mid,
        ]);

    }

    public function getFacilitiesManagers($id)
    {

        $managers = DB::select('select fm.id, fm.managerName, fm.managerEmail, fm.managerPhone 
        from facilities_managers as fm, managements as m, facilities as f
        where m.facility_id = f.id and m.manager_id = fm.id and f.id = ?', [$id]);

        return $managers;

    }

    public function removeFacilitiesManager($fid, $mid)
    {

        $managers = management::where('facility_id', $fid)
            ->where('manager_id', $mid)
            ->delete();
        return $managers;
    }

    public function removeFacilitiesManagerAll($fid)
    {
        $managers = management::where('facility_id', $fid)->delete();
        return $managers;
    }

    public function managedByStaff($id)
    {

    }

    public function facilitiesWithManager()
    {
        $facilities = facility::has('managers')->get();
        return $facilities;
    }

}