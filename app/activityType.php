<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class activityType extends Model
{
    protected $hidden = ['created_at','updated_at'];
    //
    public function activity(){
        return $this->hasMany('App\activity','activityType_code','code');
    }
}
