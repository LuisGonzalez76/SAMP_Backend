<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class staff extends Model
{
    //
    public function type(){
        return $this->belongsTo('App\staffType','staffType_code','code');
    }

    public function activity(){
        return $this->hasMany('App\activity','staff_id');
    }
}
