<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    //
    protected $table = 'transaction';
    // protected  $fillable = ['user_id','package_id','package_amount','package_name'];
    protected  $fillable = ['invoice_id','subscription_id','plan_id','renew_time','amount','next_payment','failed'];

}
