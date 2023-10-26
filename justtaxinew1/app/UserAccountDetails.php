<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAccountDetails extends Model
{
    protected $table = 'user_account';

    protected $fillable = [
        'id','bank_account','bank_name','branch_code', 'branch_name','ifsc_code','user_id',
    ];
}
