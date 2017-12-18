<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class facilityDepartment extends Model
{
    protected $hidden = ['created_at','updated_at'];

    protected $fillable = ['description'];

    //
    public function facility(){
        return $this->hasMany('App\facility','facilityDepartment_code','code');
    }
}
