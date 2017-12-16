<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class organizationType extends Model
{

    //
    public function organization(){
        return $this->hasMany('App\organization','organizationType_code','code');
    }
}
