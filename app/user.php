<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    //
    public function type(){
        return $this->belongsTo('App\userType','userType_code');
    }
}
