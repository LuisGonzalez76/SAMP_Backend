<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    protected $hidden = ['created_at','updated_at'];
    //
    public function organizations(){
        return $this->belongsToMany('App\organization','memberships',
            'student_id','organization_id');
    }

    public function activities(){
        return $this->hasMany('App\activity','student_id');
    }
}
