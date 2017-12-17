<?php
namespace App\Services\v1;

use App\Providers\v1\userServiceProvider;
use App\activity;
use App\user;

class userService{
    public function getUsers(){
        $user = user::all();
        return $user;
    }

    public function getUser($id){
        $activity  = activity::find($id)->with('student')->with('organization.counselors')
            ->with('facility.managers', 'facility.department')
            ->get();
        return $activity;
    }
}