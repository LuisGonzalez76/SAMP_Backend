<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class counselor extends Model
{
    //
    public function organizations(){
        return $this->belongsToMany('App\organization','counsels');
    }
}
