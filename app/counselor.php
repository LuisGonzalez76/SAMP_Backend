<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class counselor extends Model
{
    protected $hidden = ['created_at','updated_at','pivot'];
    //
    protected $fillable = ['counselorName','counselorEmail','counselorPhone','counselorFaculty','counselorDepartment','counselorOffice'];

    public function organizations(){
        return $this->belongsToMany('App\organization','counsels',
            'counselor_id','organization_id');
    }

    public function user(){
        return $this->belongsTo('App\user','user_id');
    }
}
