<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class facility extends Model
{
    protected $hidden = ['created_at','updated_at','isActive'];
    protected $casts = ['id'=>'integer' ,'isActive'=>'integer'];
    protected $fillable =['building','space','facilityDepartment','isActive'];

    public function managers(){
        return $this->belongsToMany('App\facilitiesManager','managements',
            'facility_id','manager_id');
    }

    public function activities(){
        return $this->hasMany('App\activity','facility_id');
    }
}
