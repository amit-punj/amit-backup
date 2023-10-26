<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model {
    protected $table = 'tickets';
    
    public function unit(){
    	return $this->belongsTo('App\PropertiesUnit', 'unit_id');
    }
    public function user(){
        return $this->belongsTo('App\User', 'tenant_id');
    }
   
}
