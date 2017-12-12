<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class facility extends Model
{
    //
    public function department(){
        return $this->belongsTo('App\facilityDepartment','facilityDepartment_code');
    }

    public function managers(){
        return $this->belongsToMany('App\facilitiesManager','managements');
    }

    public function activities(){
        return $this->hasMany('App\activity','facility_id');
    }
}
