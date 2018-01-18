<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class organizationRole extends Model
{
    protected $hidden = ['created_at','updated_at'];
    protected $casts = ['code'=>'integer'];
    //
    public function student(){
        return $this->hasMany('App\membership','organizationRole_code','code');
    }
}
