<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitsRent extends Model {
    protected $table = 'units_rent';
    public function contract() {
        return $this->belongsTo('App\Booking', 'contract_id');
    }

    public function unit() {
        return $this->belongsTo('App\PropertiesUnit', 'unit_id');
    }
}
