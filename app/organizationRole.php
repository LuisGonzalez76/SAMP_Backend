<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class organizationRole extends Model
{
    //
    public function student(){
        return $this->hasMany('App\membership','organizationRole_code');
    }
}
