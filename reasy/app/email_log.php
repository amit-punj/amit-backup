<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class email_log extends Model
{
    //
    protected $table = 'email_log';

    public function unit()
    {
    	return $this->belongsTo('App\PropertiesUnit', 'unit_id');
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
    public function tenant()
    {
        return $this->belongsTo('App\User', 'tenant_id');
        // return $this->hasMany('App\PropertiesUnit');
        // return $this->hasMany('App\Book_appointment');
    }

}
