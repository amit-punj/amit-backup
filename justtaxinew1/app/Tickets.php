<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    protected $table = 'tickets';

    protected $fillable = [
        'id','title','description','category', 'status','issue_raised_by',
    ];
}
