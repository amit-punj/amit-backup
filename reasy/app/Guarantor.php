<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guarantor extends Model
{
    //
    protected $table = 'guarantor';

    protected $fillable = [
        'id', 'unit_id', 'tenant_id','name','email','phone_no','address','photo','photo_id_proof','status'
    ];

    public function unit()
    {
    	return $this->belongsTo('App\PropertiesUnit', 'unit_id');
        // return $this->hasMany('App\PropertiesUnit');
        // return $this->hasMany('App\Book_appointment');
    }

    public function assigned()
    {
        return $this->belongsTo('App\User', 'assigned_to');
        // return $this->hasMany('App\PropertiesUnit');
        // return $this->hasMany('App\Book_appointment');
    }
    public function create()
    {
        return $this->belongsTo('App\User', 'created_by');
        // return $this->hasMany('App\PropertiesUnit');
        // return $this->hasMany('App\Book_appointment');
    }
    public function child()
    {
    	// return $this->belongsTo('App\appointments', 'parent');
        return $this->hasMany('App\appointments', 'parent');
        // return $this->hasMany('App\Book_appointment');
    }
}
