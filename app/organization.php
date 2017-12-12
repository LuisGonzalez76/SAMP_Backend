<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class organization extends Model
{
    //
    public function type(){
        return $this->belongsTo('App\organizationType','organizationType_code');
    }

    public function status(){
        return $this->belongsTo('App\organizationStatus','organizationStatus_code');
    }

    public function members(){
        return $this->belongsToMany('App\student','memberships');
    }

    public function counselors(){
        return $this->belongsToMany('App\counselor','counsels');
    }

    public function activities(){
        return $this->hasMany('App\activity','organization_id');
    }
}
