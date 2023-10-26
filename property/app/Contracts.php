<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contracts extends Model
{
    protected $table = 'contracts';

    public function unit()
    {
    	return $this->belongsTo('App\PropertiesUnit', 'property_unit_id');
        // return $this->hasMany('App\PropertiesUnit');
        // return $this->hasMany('App\Book_appointment');
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'tenent_id');
        // return $this->hasMany('App\PropertiesUnit');
        // return $this->hasMany('App\Book_appointment');
    }

   
}
