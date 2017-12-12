<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    //
    public function organizations(){
        return $this->belongsToMany('App\organization','memberships');
    }

    public function activities(){
        return $this->hasMany('App\activity','student_id');
    }
}
