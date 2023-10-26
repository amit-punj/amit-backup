<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class appointments extends Model
{
    //
    protected $table = 'appointments';

    protected $fillable = [
        'id', 'unit_id','contract_id','tenant_id','pde_id','vo_id','appointment_type','created_by','assigned_to','terminate_id','title','description','time','appointment_status','parent','IsDeleted','assign_dates'
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
    public function contract()
    {
        return $this->belongsTo('App\Booking', 'contract_id');
        // return $this->hasMany('App\PropertiesUnit');
        // return $this->hasMany('App\Book_appointment');
    }
    public function document()
    {
        return $this->hasOne('App\Documents', 'contract_id', 'contract_id')->where(['related_to' => 'EntryPDReport']);
        // return $this->hasMany('App\PropertiesUnit');
        // return $this->hasMany('App\Book_appointment');
    }
    public function child()
    {
    	// return $this->belongsTo('App\appointments', 'parent');
        return $this->hasMany('App\appointments', 'parent');
        // return $this->hasMany('App\Book_appointment');
    }
    public function tenant()
    {
        // return $this->belongsTo('App\appointments', 'parent');
        return $this->belongsTo('App\User', 'tenant_id');
        // return $this->hasMany('App\Book_appointment');
    }

    public function message()
    {
        // return $this->belongsTo('App\appointments', 'parent');
        return $this->belongsTo('App\Messages', 'id', 'appointment_id');
        // return $this->hasMany('App\Book_appointment');
    } 
    public function reason()
    {
        // return $this->belongsTo('App\appointments', 'parent');
        return $this->belongsTo('App\Reason', 'id', 'appointment_id');
        // return $this->hasMany('App\Book_appointment');
    }
    

}
