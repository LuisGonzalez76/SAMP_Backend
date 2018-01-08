<?php
    namespace App\Services\v1;

    use App\Providers\v1\studentServiceProvider;
    use App\student;
    use App\activity;
    use App\counselor;
    use App\organization;
    use App\facility;
    use App\facilitiesManager;

    class studentService{
        public function getStudents(){
           //return student::all();


            //con este puedes extraer valores especificos de los hijos
          // $activity = activity::find(1)->with(array('student'=>function($query){
               //$query->select('id','fullName');
          // }))->with('organization')->get();



            $activity  = activity::with('student')->with('organization.counselors')
                ->with('facility.managers', 'facility.department')
                ->get();


            // = facility::find(1)->managers;
            //$org = organization::find(1)->counselors;
            //return $org;
            //$facility  = facility::with('department')->get();
               // return $facility;
           return $activity;
        }
    }