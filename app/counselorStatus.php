<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class counselorStatus extends Model
{
    protected $hidden = ['created_at','updated_at'];
    //
    public function activity(){
        return $this->hasMany('App\activity','counselorStatus_code','code');
    }
}
