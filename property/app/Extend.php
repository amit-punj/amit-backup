<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extend extends Model
{
    //
    protected $table = 'extend_request';

    protected $fillable = [
        'id', 'unit_id','booking_id','tenant_id','pde_id','po_id','pm_id','transaction_id','status','extend_date','remark','isDeleted'
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
    public function pm()
    {
        return $this->belongsTo('App\User','pm_id');
    }
    public function po()
    {
        return $this->belongsTo('App\User','po_id');
    }
}
