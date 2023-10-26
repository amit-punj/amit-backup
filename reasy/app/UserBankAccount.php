<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBankAccount extends Model {
    protected $table = 'users_account';

    protected $fillable = [
        'id', 'user_id','user_type','bank_name','ada_number','account_number','routing_number','terminate_id','booking_id','paypal_email'

    ];
}
