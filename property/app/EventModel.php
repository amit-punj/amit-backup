<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventModel extends Model
{
    //
    
    
	protected $fillable = ['name', 'description', 'task_date'];
}
