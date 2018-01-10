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
        $student = student::where('isActive',1)->get();
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
            $userTemp = user::where('userEmail',$request['studentEmail'])->get()->first();
            $userCount = count($userTemp);
            if($userCount==0){
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
                return $student;
            }
            else{
                $u_id = $userTemp->id;
                $u_type = $userTemp->userType_code;

                if($u_type==1){
                    $admin = staff::where('staffEmail',$request['studentEmail'])->get()->first();
                    $admin->isActive = 0;
                    $admin->save();

                }
                if($u_type==2){
                    $staff = staff::where('staffEmail',$request['studentEmail'])->get()->first();
                    $staff->isActive = 0;
                    $staff->save();
                }
                if($u_type==3){

                }
                if($u_type==4){
                    $counselor = counselor::where('counselorEmail',$request['studentEmail'])->get()->first();
                    $counselor->isActive = 0;
                    $counselor->save();
                }
                if($u_type==5){
                    $manager = facilitiesManager::where('managerEmail',$request['studentEmail'])->get()->first();
                    $manager->isActive = 0;
                    $manager->save();
                }

                $userTemp->userType_code = 3;
                $userTemp->save();

                $studentTemp = student::where('studentEmail',$request['studentEmail'])->get()->first();

                if(count($studentTemp)==0){

                    $student = student::create([
                        'studentName' => $request['studentName'],
                        'studentEmail' => $request['studentEmail'],
                        'studentNo' => $request['studentNo'],
                        'studentPhone' => $request['studentPhone'],
                        'studentAddress' => $request['studentAddress'],
                        'studentCity' => $request['studentCity'],
                        'studentCountry' => $request['studentCountry'],
                        'studentZipCode' => $request['studentZipCode'],
                        'user_id' => $u_id,
                        'isActive' => 1,
                    ]);
                    return $student;
                }
                else{
                    $studentTemp->isActive = 1;
                    $studentTemp->save();
                    return $studentTemp;
                }
            }

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
        $counselor = counselor::where('isActive',1)->get();
            return $counselor;
    }

    public function getCounselor($id){
        $counselor = counselor::find($id);
        return $counselor;
    }

    public function getManagers(){
        $manager = facilitiesManager::where('isActive',1)->get();
        return $manager;
    }

    public function getManager($id){
        $manager = facilitiesManager::find($id);
        return $manager;
    }
    public function getStaffs(){
        $staff = staff::where('staffType_code',2)->where('isActive',1)->get();
        return $staff;
    }

    public function getStaff($id){
        $staff = staff::find($id);
        return $staff;
    }

    public function storeStaff($request){
        if($request!=null){

            $userTemp = user::where('userEmail',$request['staffEmail'])->get()->first();
            $userCount = count($userTemp);
            if($userCount==0){
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

                $manager = facilitiesManager::create([

                    'managerName' => $request['staffName'],
                    'managerEmail' => $request['staffEmail'],
                    'managerPhone' => $request['staffPhone'],
                    'user_id' => $u_id->id,
                    'isActive' => 0,
                ]);
                return $staff;
            }
            else{
                $u_id = $userTemp->id;
                $u_type = $userTemp->userType_code;

                if($u_type==1){
                    $admin = staff::where('staffEmail',$request['staffEmail'])->get()->first();
                    $admin->staffType_code = 2;
                    $admin->save();

                }
                if($u_type==2){

                }
                if($u_type==3){
                    $student = student::where('studentEmail',$request['staffEmail'])->get()->first();
                    $student->isActive = 0;
                    $student->save();
                }
                if($u_type==4){
                    $counselor = counselor::where('counselorEmail',$request['staffEmail'])->get()->first();
                    $counselor->isActive = 0;
                    $counselor->save();
                }
                if($u_type==5){
                    $manager = facilitiesManager::where('managerEmail',$request['staffEmail'])->get()->first();
                    $manager->isActive = 0;
                    $manager->save();
                }

                $userTemp->userType_code = 2;
                $userTemp->save();

                $staffTemp = staff::where('staffEmail',$request['staffEmail'])->get()->first();

                if(count($staffTemp)==0){
                    $staff = staff::create([
                        'staffName' => $request['staffName'],
                        'staffEmail' => $request['staffEmail'],
                        'staffPhone' => $request['staffPhone'],
                        'staffType_code' => 2,
                        'user_id' => $u_id,
                        'isActive' => 1,
                    ]);
                    $managerTemp = facilitiesManager::where('managerEmail',$request['staffEmail'])->get()->first();

                    if(count($managerTemp)==0){
                        $manager = facilitiesManager::create([

                            'managerName' => $request['staffName'],
                            'managerEmail' => $request['staffEmail'],
                            'managerPhone' => $request['staffPhone'],
                            'user_id' => $u_id,
                            'isActive' => 0
                        ]);
                    }
                    return $staff;
                }
                else{
                    $staffTemp->isActive = 1;
                    $staffTemp->staffType_code = 2;
                    $staffTemp->save();
                    return $staffTemp;
                }


            }


        }
        else{
            return response() -> json(['message' => 'No data is present in request!'], 200);
        }
    }



    public function getAdmins(){
        $admin = staff::where('staffType_code',1)->where('isActive',1)->get();
        return $admin;
    }

    public function getAdmin($id){
        $staff = staff::where('id','=',$id)->where('staffType_code',1)->get()->first();
        return $staff;
    }

    public function storeAdmin($request){
        if($request!=null){

            $userTemp = user::where('userEmail',$request['staffEmail'])->get()->first();
            $userCount = count($userTemp);
            if($userCount==0){
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

                $manager = facilitiesManager::create([

                    'managerName' => $request['staffName'],
                    'managerEmail' => $request['staffEmail'],
                    'managerPhone' => $request['staffPhone'],
                    'user_id' => $u_id->id,
                    'isActive' => 0,
                ]);
                return $staff;
            }
            else{
                $u_id = $userTemp->id;
                $u_type = $userTemp->userType_code;

                if($u_type==1){


                }
                if($u_type==2){
                    $admin = staff::where('staffEmail',$request['staffEmail'])->get()->first();
                    $admin->staffType_code = 1;
                    $admin->save();
                }
                if($u_type==3){
                    $student = student::where('studentEmail',$request['staffEmail'])->get()->first();
                    $student->isActive = 0;
                    $student->save();
                }
                if($u_type==4){
                    $counselor = counselor::where('counselorEmail',$request['staffEmail'])->get()->first();
                    $counselor->isActive = 0;
                    $counselor->save();
                }
                if($u_type==5){
                    $manager = facilitiesManager::where('managerEmail',$request['staffEmail'])->get()->first();
                    $manager->isActive = 0;
                    $manager->save();
                }

                $userTemp->userType_code = 1;
                $userTemp->save();

                $staffTemp = staff::where('staffEmail',$request['staffEmail'])->get()->first();

                if(count($staffTemp)==0){
                    $staff = staff::create([
                        'staffName' => $request['staffName'],
                        'staffEmail' => $request['staffEmail'],
                        'staffPhone' => $request['staffPhone'],
                        'staffType_code' => 1,
                        'user_id' => $u_id,
                        'isActive' => 1,
                    ]);

                    $managerTemp = facilitiesManager::where('managerEmail',$request['staffEmail'])->get()->first();

                    if(count($managerTemp)==0){
                        $manager = facilitiesManager::create([

                            'managerName' => $request['staffName'],
                            'managerEmail' => $request['staffEmail'],
                            'managerPhone' => $request['staffPhone'],
                            'user_id' => $u_id,
                            'isActive' => 0
                        ]);
                    }
                    return $staff;
                }
                else{
                    $staffTemp->isActive = 1;
                    $staffTemp->staffType_code = 1;
                    $staffTemp->save();
                    return $staffTemp;
                }


            }


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
            $userTemp = user::where('userEmail',$request['counselorEmail'])->get()->first();
            $userCount = count($userTemp);
            if($userCount==0){
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
                    'isActive' => 1
                ]);
                return $counselor;
            }
            else{
                $u_id = $userTemp->id;
                $u_type = $userTemp->userType_code;

                if($u_type==1){
                    $admin = staff::where('staffEmail',$request['counselorEmail'])->get()->first();
                    $admin->isActive = 0;
                    $admin->save();

                }
                if($u_type==2){
                    $staff = staff::where('staffEmail',$request['counselorEmail'])->get()->first();
                    $staff->isActive = 0;
                    $staff->save();
                }
                if($u_type==3){
                    $counselor = student::where('studentEmail',$request['counselorEmail'])->get()->first();
                    $counselor->isActive = 0;
                    $counselor->save();
                }
                if($u_type==4){

                }
                if($u_type==5){
                    $manager = facilitiesManager::where('managerEmail',$request['counselorEmail'])->get()->first();
                    $manager->isActive = 0;
                    $manager->save();
                }

                $userTemp->userType_code = 4;
                $userTemp->save();

                $counselorTemp = counselor::where('counselorEmail',$request['counselorEmail'])->get()->first();

                if(count($counselorTemp)==0){
                    $counselor = counselor::create([

                        'counselorName' => $request['counselorName'],
                        'counselorEmail' => $request['counselorEmail'],
                        'counselorPhone' => $request['counselorPhone'],
                        'counselorFaculty' => $request['counselorFaculty'],
                        'counselorDepartment' => $request['counselorDepartment'],
                        'counselorOffice' => $request['counselorOffice'],
                        'user_id' => $u_id,
                        'isActive' => 1
                    ]);
                    return $counselor;
                }
                else{
                    $counselorTemp->isActive = 1;
                    $counselorTemp->save();
                    return $counselorTemp;
                }
            }

        }
        else{
            return response() -> json(['message' => 'No data is present in request!'], 200);
        }
    }

    public function updateCounselor($request,$id){
        $counselor = counselor::where('id',$id)->get()->first();
        $s_json = json_decode($counselor);
        $u_id = $s_json->user_id;
        $user = user::where('id',$u_id)->get()->first();

        $user->userEmail = $request->input('counselorEmail');

        $counselor->counselorName = $request->input('counselorName');
        $counselor->counselorEmail = $request->input('counselorEmail');
        $counselor->counselorPhone = $request->input('counselorPhone');
        $counselor->counselorFaculty = $request->input('counselorFaculty');
        $counselor->counselorDepartment = $request->input('counselorDepartment');
        $counselor->counselorOffice = $request->input('counselorOffice');

        $user->save();
        $counselor->save();

    }



    public function storeManager($request){
        if($request!=null){
            $userTemp = user::where('userEmail',$request['managerEmail'])->get()->first();
            $userCount = count($userTemp);
            if($userCount==0){
                $user = user::create([
                    'userEmail'=> $request['managerEmail'],
                    'userType_code' => 5,
                ]);
                $u_id = json_decode($user);
                // dd($request['counselorName']);
                $manager = facilitiesManager::create([

                    'managerName' => $request['managerName'],
                    'managerEmail' => $request['managerEmail'],
                    'managerPhone' => $request['managerPhone'],
                    'user_id' => $u_id->id,
                    'isActive' => 1
                ]);
                return $manager;
            }
            else{
                $u_id = $userTemp->id;
                $u_type = $userTemp->userType_code;

                if($u_type==1){
                    $admin = staff::where('staffEmail',$request['managerEmail'])->get()->first();
                    $admin->isActive = 0;
                    $admin->save();

                }
                if($u_type==2){
                    $staff = staff::where('staffEmail',$request['managerEmail'])->get()->first();
                    $staff->isActive = 0;
                    $staff->save();
                }
                if($u_type==3){
                    $student = student::where('studentEmail',$request['managerEmail'])->get()->first();
                    $student->isActive = 0;
                    $student->save();
                }
                if($u_type==4){
                    $counselor = counselor::where('counselorEmail',$request['managerEmail'])->get()->first();
                    $counselor->isActive = 0;
                    $counselor->save();
                }
                if($u_type==5){

                }
                $userTemp->userType_code = 5;
                $userTemp->save();

                $managerTemp = facilitiesManager::where('managerEmail',$request['managerEmail'])->get()->first();

                if(count($managerTemp)==0){
                    $manager = facilitiesManager::create([

                        'managerName' => $request['managerName'],
                        'managerEmail' => $request['managerEmail'],
                        'managerPhone' => $request['managerPhone'],
                        'user_id' => $u_id,
                        'isActive' => 1
                    ]);
                    return $manager;
                }

                else{
                    $managerTemp->isActive = 1;
                    $managerTemp->save();
                    return $managerTemp;
                }

            }

        }
        else{
            return response() -> json(['message' => 'No data is present in request!'], 200);
        }
    }


    public function updateManager($request,$id){
        $manager = facilitiesManager::where('id',$id)->get()->first();
        $s_json = json_decode($manager);
        $u_id = $s_json->user_id;
        $user = user::where('id',$u_id)->get()->first();

        $user->userEmail = $request->input('managerEmail');

        $manager->managerName = $request->input('managerName');
        $manager->managerEmail = $request->input('managerEmail');
        $manager->managerPhone = $request->input('managerPhone');

        $user->save();
        $manager->save();

    }
}