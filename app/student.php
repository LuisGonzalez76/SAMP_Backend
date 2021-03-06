<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    protected $hidden = ['created_at','updated_at'];
    protected $casts = ['id'=>'integer' ,'user_id'=>'integer','isActive'=>'integer'];
    protected $fillable = ['studentName','studentEmail','studentNo','studentPhone','studentAddress',
        'studentCity','studentCountry','studentZipCode','user_id','isActive'];
    //
    public function organizations(){
        return $this->belongsToMany('App\organization','memberships',
            'student_id','organization_id')->withPivot('organizationRole_code');
    }

    public function activities(){
        return $this->hasMany('App\activity','student_id');
    }

    public function user(){
        return $this->belongsTo('App\user','user_id');
    }
}
