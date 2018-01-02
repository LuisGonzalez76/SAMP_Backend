<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class membership extends Model
{
    protected $hidden = ['created_at','updated_at'];
    //
    public function role(){
        return $this->belongsTo('App\organizationRole','organizationRole_code');
    }
}
