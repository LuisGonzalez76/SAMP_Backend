<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class activityType extends Model
{
    //
    public function activity(){
        return $this->hasMany('App\activity','activityType_code');
    }
}
