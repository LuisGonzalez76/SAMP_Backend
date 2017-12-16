<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userType extends Model
{
    //
    public function user(){
        return $this->hasMany('App\user','userType_code','code');
    }
}
