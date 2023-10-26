<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersAvailability extends Model
{

    protected $table = 'users_availability';
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
