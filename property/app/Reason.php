<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    //
    protected $table = 'appointment_reason';

    protected $fillable = [
        'id', 'unit_id', 'appointment_id','booking_id','tenant_id','tenant_id','pde_id','vo_id','send','received','type','reason
        ','time'
    ];

    public function unit()
    {
    	return $this->belongsTo('App\PropertiesUnit', 'unit_id');
        // return $this->hasMany('App\PropertiesUnit');
        // return $this->hasMany('App\Book_appointment');
    }

    public function appointment()
    {
        return $this->belongsTo('App\appointments', 'appointment_id');
        // return $this->hasMany('App\PropertiesUnit');
        // return $this->hasMany('App\Book_appointment');
    }

    public function assigned()
    {
        return $this->belongsTo('App\User', 'received');
        // return $this->hasMany('App\PropertiesUnit');
        // return $this->hasMany('App\Book_appointment');
    }
    public function create()
    {
        return $this->belongsTo('App\User', 'send');
        // return $this->hasMany('App\PropertiesUnit');
        // return $this->hasMany('App\Book_appointment');
    }

}
