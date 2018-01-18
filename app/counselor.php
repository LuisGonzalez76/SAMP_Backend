<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class counselor extends Model
{
    protected $hidden = ['created_at','updated_at','pivot'];
    protected $casts = ['id'=>'integer' ,'user_id'=>'integer','isActive'=>'integer'];
    //
    protected $fillable = ['counselorName','counselorEmail','counselorPhone','counselorFaculty',
        'counselorDepartment','counselorOffice','user_id','isActive'];

    public function organizations(){
        return $this->belongsToMany('App\organization','counsels',
            'counselor_id','organization_id');
    }

    public function user(){
        return $this->belongsTo('App\user','user_id');
    }
}
