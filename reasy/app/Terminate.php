<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terminate extends Model
{
    //
    protected $table = 'terminate';

    protected $fillable = [
        'id', 'unit_id', 'step','booking_id','tenant_id','pde_id','po_id','pm_id','appointment_id','appointment_time','notice','report','pay_dues','status','claim_method','notice_period_date'
    ];

    public function unit()
    {
    	return $this->belongsTo('App\PropertiesUnit', 'unit_id');
        // return $this->hasMany('App\PropertiesUnit');
        // return $this->hasMany('App\Book_appointment');
    }

    public function pde()
    {
        return $this->belongsTo('App\User', 'pde_id');
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
    public function transactions()
    {
        // return $this->belongsTo('App\appointments', 'parent');
        return $this->hasMany('App\Transactions', 'id');
        // return $this->hasMany('App\Book_appointment');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'tenant_id');
        // return $this->hasMany('App\PropertiesUnit');
        // return $this->hasMany('App\Book_appointment');
    }
    public function contract()
    {
        return $this->belongsTo('App\Booking', 'booking_id');
        // return $this->hasMany('App\PropertiesUnit');
        // return $this->hasMany('App\Book_appointment');
    }
}
