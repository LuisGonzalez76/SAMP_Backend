<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userType extends Model
{
    protected $hidden = ['created_at','updated_at'];
    //
    public function user(){
        return $this->hasMany('App\user','userType_code','code');
    }
}
