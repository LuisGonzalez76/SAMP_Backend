<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class facility extends Model
{
    protected $hidden = ['created_at','updated_at','facilityDepartment_code'];
    //
    public function department(){
        return $this->belongsTo('App\facilityDepartment','facilityDepartment_code','code');
    }

    public function managers(){
        return $this->belongsToMany('App\facilitiesManager','managements',
            'facility_id','manager_id');
    }

    public function activities(){
        return $this->hasMany('App\activity','facility_id');
    }
}
