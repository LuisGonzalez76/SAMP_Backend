<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class activityStatus extends Model
{
    //
    public function activity(){
        return $this->hasMany('App\activity','activityStatus_code','code');
    }
}
