<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class staffType extends Model
{
    //
    public function staff(){
        return $this->hasMany('App\staff','staffType_code');
    }
}
