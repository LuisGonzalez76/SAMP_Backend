<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class management extends Model
{
    protected $hidden = ['created_at','updated_at'];
    //
    protected $fillable = ['facility_id','manager_id'];
    protected $casts = ['id'=>'integer','facility_id'=>'integer' ,'manager_id'=>'integer'];
}
