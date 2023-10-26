<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembershipPayments extends Model
{
     protected $table = 'membership_payments';
      public function user_membership()
    {
        	return $this->belongsTo('App\User','user_id');
    }
    public function plan()
    {
    	return $this->belongsTo('App\Plans','plan_id');
    }
}
