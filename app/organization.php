<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class organization extends Model
{
    protected $casts = ['id'=>'integer' ,'organizationType_code'=>'integer','isActive'=>'integer'];
    protected $hidden = ['organizationStatus_code','created_at','updated_at'];
    //
    protected $fillable = ['organizationName','organizationInitials','organizationType_code',
        'organizationStatus_code','url'];

    public function type(){
        return $this->belongsTo('App\organizationType','organizationType_code','code');
    }

    public function members(){
        return $this->belongsToMany('App\student','memberships',
            'organization_id','student_id');
    }

    public function counselors(){
        return $this->belongsToMany('App\counselor','counsels',
            'organization_id','counselor_id');
    }

    public function activities(){
        return $this->hasMany('App\activity','organization_id');
    }

}
