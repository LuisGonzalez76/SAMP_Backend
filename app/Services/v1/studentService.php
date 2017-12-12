<?php
    namespace App\Services\v1;

    use App\Providers\v1\studentServiceProvider;
    use App\student;
    use App\activity;

    class studentService{
        public function getStudents(){
           // return student::all();
           $activity = activity::with('student')->with('organization')->with('facility')->get();

            return $activity;
        }
    }