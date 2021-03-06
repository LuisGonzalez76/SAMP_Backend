<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class staffType extends Model
{
    protected $hidden = ['created_at','updated_at'];
    protected $casts = ['code'=>'integer'];
    //
    public function staff(){
        return $this->hasMany('App\staff','staffType_code','code');
    }
}
