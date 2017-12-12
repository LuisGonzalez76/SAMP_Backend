<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class managerStatus extends Model
{
    //
    public function activity(){
        return $this->hasMany('App\activity','managerStatus_code');
    }
}
