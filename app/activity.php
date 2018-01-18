<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class activity extends Model
{
    protected $casts = ['id'=>'integer' ,'student_id'=>'integer',
        'organization_id'=>'integer','facility_id'=>'integer','staff_id'=>'integer',
        'attendantsNumber'=>'integer','activityStatus_code'=>'integer',
        'counselorStatus_code'=>'integer','managerStatus_code'=>'integer',
        'activityType_code'=>'integer'];

    protected $hidden = ['student_id','organization_id','staff_id','facility_id','created_at','updated_at'];
    protected $fillable = ['student_id','organization_id','staff_id','facility_id',
        'activityName','activityDescription','attendantsNumber','activityDate','activityStatus_code',
        'hasFood','hasGuest','guestName','counselorStatus_code','managerStatus_code','activityType_code',
        'activityStart','activityEnd','counselorComment','managerComment','staffComment'];
    //Statuses and Types
    public function status(){
        return $this->belongsTo('App\activityStatus','activityStatus_code','code');
    }

    public function type(){
        return $this->belongsTo('App\activityType','activityType_code','code');
    }

    public function counselor_status(){
        return $this->belongsTo('App\counselorStatus','counselorStatus_code','code');
    }

    public function manager_status(){
        return $this->belongsTo('App\managerStatus','managerStatus_code','code');
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
