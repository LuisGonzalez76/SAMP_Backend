<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class membership extends Model
{
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['student_id','organization_id','organizationRole_code'];
    protected $casts = ['id'=>'integer','student_id'=>'integer',
        'organization_id'=>'integer','organizationRole_code'=>'integer'];
    //
    public function role(){
        return $this->belongsTo('App\organizationRole','organizationRole_code');
    }
}
