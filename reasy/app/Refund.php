<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    //
    protected $table = 'refunds';


	protected $fillable = ['id', 'contract_id','unit_id','po_id','refund_amount','method','refundID','status','time','related_to','created_at','updated_at'];

}
