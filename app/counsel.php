<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class counsel extends Model
{
    protected $hidden = ['created_at','updated_at'];
    //
    protected $fillable =['counselor_id','organization_id'];
    protected $casts = ['id'=>'integer','counselor_id'=>'integer' ,'organization_id'=>'integer'];
}
