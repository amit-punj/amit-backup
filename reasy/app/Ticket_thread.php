<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket_thread extends Model {
    protected $table = 'ticket_threads';
    
    public function unit(){
    	return $this->belongsTo('App\PropertiesUnit', 'unit_id');
    }
    public function user(){
        return $this->belongsTo('App\User', 'tenant_id');
    }
    public function create(){
        return $this->belongsTo('App\User', 'send');
    }
    public function booking(){
        return $this->belongsTo('App\User', 'booking_id');
    }
   
}
