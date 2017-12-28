<?php
namespace App\Services\v1;

use App\Providers\v1\studentServiceProvider;
use App\student;
use App\activity;
use App\counselor;
use App\organization;
use App\facility;
use App\facilitiesManager;

class activityService{
    public function getActivities(){
        //con este puedes extraer valores especificos de los hijos
        /* $activity = activity::find(1)->with(array('student'=>function($query){
            $query->select('id','fullName');
        }))->with('organization')->get();
        */

        $activity  = activity::with('student')->with('organization.counselors')
            ->with('facility.managers', 'facility.department')
            ->get();

        //esto sirve para encontar el user sin saber el id
       // $activity = student::where('studentEmail','lg@upr.edu')->get()->first()->id;


        return $activity;
    }

    public function getActivity($id){
        $activity  = activity::find($id)->with('student')->with('organization.counselors')
            ->with('facility.managers', 'facility.department')
            ->get();
        return $activity;
    }



    public function getPending(){
        $pending = activity::where('activityStatus_code', 1)->count('activityStatus_code');
        return $pending;
    }

    public function getApproved(){
        $approved = activity::where('activityStatus_code', 2)->count('activityStatus_code');
        return $approved;
    }

    public function getDenied(){
        $denied = activity::where('activityStatus_code', 3)->count('activityStatus_code');
        return $denied;
    }


}