<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class counsel extends Model
{
    protected $hidden = ['created_at','updated_at'];
    //
    protected $fillable =['counselor_id','organization_id'];
}
