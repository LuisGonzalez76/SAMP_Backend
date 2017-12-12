<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class facilityDepartment extends Model
{
    //
    public function facility(){
        return $this->hasMany('App\facility','facilityDepartment_code');
    }
}
