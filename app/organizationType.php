<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class organizationType extends Model
{
    protected $hidden = ['created_at','updated_at'];
    protected $casts = ['code'=>'integer'];
    //
    public function organization(){
        return $this->hasMany('App\organization','organizationType_code','code');
    }
}
