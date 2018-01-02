<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['userEmail','userType_code'];
    //
    public function type(){
        return $this->belongsTo('App\userType','userType_code','code');
    }

    public function students(){
        return $this->hasMany('App\student','user_id');
    }

    public function managers(){
        return $this->hasMany('App\facilitiesManager','user_id');
    }

    public function counselors(){
        return $this->hasMany('App\counselor','user_id');
    }

    public function staff(){
        return $this->hasMany('App\staff','user_id');
    }
}
