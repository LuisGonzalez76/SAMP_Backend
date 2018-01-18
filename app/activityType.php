<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class activityType extends Model
{
    protected $hidden = ['created_at','updated_at'];
    protected $casts = ['code'=>'integer'];
    //
    public function activity(){
        return $this->hasMany('App\activity','activityType_code','code');
    }
}
