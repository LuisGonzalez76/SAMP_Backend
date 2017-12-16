<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class organizationStatus extends Model
{
    //
    public function organization(){
        return $this->hasMany('App\organization','organizationStatus_code','code');
    }
}
