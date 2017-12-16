<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class activity extends Model
{
    protected $hidden = ['student_id','organization_id','staff_id','facility_id','created_at','updated_at'];
    //Statuses and Types
    public function status(){
        return $this->belongsTo('App\activityStatus','activityStatus_code');
    }

    public function type(){
        return $this->belongsTo('App\activityType','activityType_code');
    }

    public function counselor_status(){
        return $this->belongsTo('App\counselorStatus','counselorStatus_code');
    }

    public function manager_status(){
        return $this->belongsTo('App\managerStatus','managerStatus_code');
    }

    //Entities

    public function student(){
        return $this->belongsTo('App\student','student_id');
    }

    public function organization(){
        return $this->belongsTo('App\organization','organization_id');
    }

    public function facility(){
        return $this->belongsTo('App\facility','facility_id');
    }

    public function staff(){
        return $this->belongsTo('App\staff','staff_id');
    }

}
