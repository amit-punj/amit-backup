<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    
    
	protected $fillable = ['name', 'description', 'task_date','status','unit_id','contract_id','MeterReading_id','purpose','rent_id'];
}
