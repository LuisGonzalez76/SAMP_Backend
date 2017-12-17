<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class facilitiesManager extends Model
{
    protected $hidden = ['created_at','updated_at','pivot'];
    protected $fillable = ['fullName','managerEmail','managerPhone'];
    //
    public function facilities(){
        return $this->belongsToMany('App\facility','managements',
            'manager_id','facility_id');
    }
}
