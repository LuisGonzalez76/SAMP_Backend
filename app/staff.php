<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class staff extends Model
{
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['staffName','staffEmail','staffPhone','staffType_code','user_id','isActive'];
    //
    public function type(){
        return $this->belongsTo('App\staffType','staffType_code','code');
    }

    public function activity(){
        return $this->hasMany('App\activity','staff_id');
    }

    public function user(){
        return $this->belongsTo('App\user','user_id');
    }
}
