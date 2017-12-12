<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class facilitiesManager extends Model
{
    //
    public function facilities(){
        return $this->belongsToMany('App\facility','managements');
    }
}
