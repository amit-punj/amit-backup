<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LegalActions extends Model {

    protected $table = 'leagl_actions';

    public function tenant() {
        return $this->belongsTo('App\User', 'tenant_id');
    }

    public function propertyOwner() {
        return $this->belongsTo('App\User', 'po_id');
    }

    public function legalAdvisor() {
        return $this->belongsTo('App\User', 'legal_advisor_id');
    }

    public function contract() {
        return $this->belongsTo('App\Booking', 'contract_id');
    }

    public function unit() {
        return $this->belongsTo('App\PropertiesUnit', 'unit_id');
    }
}
