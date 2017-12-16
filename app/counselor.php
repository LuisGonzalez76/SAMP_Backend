<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class counselor extends Model
{
    protected $hidden = ['created_at','updated_at','pivot'];
    //
    public function organizations(){
        return $this->belongsToMany('App\organization','counsels');
    }
}
