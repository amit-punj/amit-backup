<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderAccountDetails extends Model
{
    protected $table = 'provider_account';

    protected $fillable = [
        'id','bank_account','bank_name','branch_code', 'branch_name','ifsc_code','provider_id',
    ];
}
