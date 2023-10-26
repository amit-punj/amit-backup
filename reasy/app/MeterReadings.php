<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeterReadings extends Model
{
    protected $table = 'meter_readings';
    public function unit() {
    	return $this->belongsTo('App\PropertiesUnit', 'unit_id');
    }

    public function meter() {
    	return $this->belongsTo('App\Meters', 'meter_id');
    }
}
