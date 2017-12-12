<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class membership extends Model
{
    //
    public function role(){
        return $this->belongsTo('App\organizationRole','organizationRole_code');
    }
}
