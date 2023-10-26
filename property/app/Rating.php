<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //
    protected $table = 'rating';
    
	protected $fillable = ['id', 'contract_id','unit_id','given_by','given_to','rating','created_at','updated_at'];
}
