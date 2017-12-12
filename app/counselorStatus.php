<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class counselorStatus extends Model
{
    //
    public function activity(){
        return $this->hasMany('App\activity','counselorStatus_code');
    }
}
