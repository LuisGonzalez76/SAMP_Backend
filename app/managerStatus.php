<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class managerStatus extends Model
{
    protected $hidden = ['created_at','updated_at'];
    //
    public function activity(){
        return $this->hasMany('App\activity','managerStatus_code','code');
    }
}
