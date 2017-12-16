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
}