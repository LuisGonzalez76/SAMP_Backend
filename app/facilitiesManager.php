<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class facilitiesManager extends Model
{
    protected $fillable = ['fullName','managerEmail','managerPhone'];

    //
    public function facilities(){
        return $this->belongsToMany('App\facility','managements');
    }
}
