<?php
namespace App\Services\v1;

use App\Providers\v1\userServiceProvider;
use App\activity;
use App\user;
use App\student;
use App\counselor;
use App\staff;
use App\facilitiesManager;

class userService{
    public function getUsers(){
        $temp = [];
        $student =array_add($temp,'students',user::with('students','type')->where('userType_code',3)->get()); ;
        $admin = array_add($student,'administrators',user::with('staff','type')->where('userType_code',1)->get());
        $staff = array_add($admin,'staff',user::with('staff','type')->where('userType_code',2)->get());
        $counselor = array_add($staff,'counselors',user::with('counselors','type')->where('userType_code',4)->get());
        $manager = array_add($counselor,'managers',user::with('managers','type')->where('userType_code',5)->get());

        return $manager;

        //$user = user::with('students','type')->where('userType_code',3)->get();
        //return $user;
    }

    public function getUser($email){
        $user = user::where('userEmail',$email)->get()->first();

        $u_json = json_decode($user);
        $type = $u_json->userType_code;

        if($type == 1){
            return user::where('userEmail',$email)->with('staff','type')->get()->first();
        }
        if($type == 2){
            return user::where('userEmail',$email)->with('staff','type')->get()->first();
        }
        if($type == 3){
            return user::where('userEmail',$email)->with('students','type')->get()->first();
        }
        if($type == 4){
            return user::where('userEmail',$email)->with('counselors','type')->get()->first();
        }
        if($type == 5){
            return user::where('userEmail',$email)->with('managers','type')->get()->first();
        }


    }

    public function getStudents(){
        $student = student::all();
        return $student;
    }

    public function getStudent($id){
        $student =student::find($id);
        return $student;
    }

    public function getStudentByEmail($email){
        $student = student::where('studentEmail',$email)->get()->first();
        return $student;
    }

    public function storeStudent($request){
        if($request!=null){
            $user = user::create([
                'userEmail'=> $request['studentEmail'],
                'userType_code' => 3,
            ]);
            $u_id = json_decode($user);

            $student = student::create([
                'studentName' => $request['studentName'],
                'studentEmail' => $request['studentEmail'],
                'studentNo' => $request['studentNo'],
                'studentPhone' => $request['studentPhone'],
                'studentAddress' => $request['studentAddress'],
                'studentCity' => $request['studentCity'],
                'studentCountry' => $request['studentCountry'],
                'studentZipCode' => $request['studentZipCode'],
                'user_id' => $u_id->id,
                'isActive' => 1,

            ]);
        }
        else{
            return response() -> json(['message' => 'No data is present in request!'], 200);
        }
    }

    public function updateStudent($request,$id){
        $student = student::where('id',$id)->get()->first();
        $s_json = json_decode($student);
        $u_id = $s_json->user_id;
        $user = user::where('id',$u_id)->get()->first();

        $user->userEmail = $request->input('studentEmail');

        $student->studentName = $request->input('studentName');
        $student->studentEmail = $request->input('studentEmail');
        $student->studentNo = $request->input('studentNo');
        $student->studentPhone = $request->input('studentPhone');
        $student->studentAddress = $request->input('studentAddress');
        $student->studentCity = $request->input('studentCity');
        $student->studentCountry = $request->input('studentCountry');
        $student->studentZipCode = $request->input('studentZipCode');

        $user->save();
        $student->save();

    }



    public function getCounselors(){
        $counselor = counselor::all();
            return $counselor;
    }

    public function getCounselor($id){
        $counselor = counselor::find($id);
        return $counselor;
    }

   /* public function storeCounselor($request){

        //$counselor = new counselor;
        //$counselor = $request->all();

        if(!$this->counselorEmailExist($request)){

            $counselor = counselor::create([
                'counselorName' => $request['counselorName'],
                'counselorEmail' => $request['counselorEmail'],
                'counselorPhone' => $request['counselorPhone'],
                'counselorFaculty' => $request['counselorFaculty'],
                'counselorDepartment' => $request['counselorDepartment'],
                'counselorOffice' => $request['counselorOffice'],
            ]);

        }

        else{

            return response('User already exists', 200)
                ->header('Content-Type', 'text/plain');

        }


    }

    public function counselorEmailExist($request){

        $email = counselor::where('counselorEmail',$request['counselorEmail'])
            ->get();

        if(count($email) > 0){
            return true;
        }

        else{
            return false;
        }

    }*/

    public function getManagers(){
        $manager = facilitiesManager::all();
        return $manager;
    }

    public function getManager($id){
        $manager = facilitiesManager::find($id);
        return $manager;
    }
    public function getStaffs(){
        $staff = staff::where('staffType_code',2)->get();
        return $staff;

    }

    public function getStaff($id){
        $staff = staff::find($id);
        return $staff;
    }

    public function storeStaff($request){
        if($request!=null){
            $user = user::create([
                'userEmail'=> $request['staffEmail'],
                'userType_code' => 2,
            ]);
            $u_id = json_decode($user);

            $staff = staff::create([
                'staffName' => $request['staffName'],
                'staffEmail' => $request['staffEmail'],
                'staffPhone' => $request['staffPhone'],
                'staffType_code' => 2,
                'user_id' => $u_id->id,
                'isActive' => 1,
            ]);
        }
        else{
            return response() -> json(['message' => 'No data is present in request!'], 200);
        }
    }



    public function getAdmins(){
        $admin = staff::where('staffType_code',1)->get();
        return $admin;
    }

    public function getAdmin($id){
        $staff = staff::where('id','=',$id)->where('staffType_code',1)->get()->first();
        return $staff;
    }

    public function storeAdmin($request){
        if($request!=null){
            $user = user::create([
                'userEmail'=> $request['staffEmail'],
                'userType_code' => 1,
            ]);
            $u_id = json_decode($user);

            $staff = staff::create([
                'staffName' => $request['staffName'],
                'staffEmail' => $request['staffEmail'],
                'staffPhone' => $request['staffPhone'],
                'staffType_code' => 1,
                'user_id' => $u_id->id,
                'isActive' => 1,
            ]);
        }
        else{
            return response() -> json(['message' => 'No data is present in request!'], 200);
        }
    }

    public function updateStaff($request,$id){
        $staff = staff::where('id',$id)->get()->first();
        $s_json = json_decode($staff);
        $u_id = $s_json->user_id;
        $user = user::where('id',$u_id)->get()->first();

        $user->userEmail = $request->input('staffEmail');

        $staff->staffName = $request->input('staffName');
        $staff->staffEmail = $request->input('staffEmail');
        $staff->staffPhone = $request->input('staffPhone');

        $user->save();
        $staff->save();

    }


    public function storeCounselor($request){
        if($request!=null){
            $user = user::create([
                'userEmail'=> $request['counselorEmail'],
                'userType_code' => 4,
            ]);
            $u_id = json_decode($user);
           // dd($request['counselorName']);
            $counselor = counselor::create([

                'counselorName' => $request['counselorName'],
                'counselorEmail' => $request['counselorEmail'],
                'counselorPhone' => $request['counselorPhone'],
                'counselorFaculty' => $request['counselorFaculty'],
                'counselorDepartment' => $request['counselorDepartment'],
                'counselorOffice' => $request['counselorOffice'],
                'user_id' => $u_id->id,
                //'isActive' => 1
            ]);
        }
        else{
            return response() -> json(['message' => 'No data is present in request!'], 200);
        }
    }


}