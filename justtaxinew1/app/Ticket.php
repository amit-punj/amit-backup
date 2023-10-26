<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    protected $fillable = [
        'id','title','description','category', 'status','issue_raised_by',
    ];

    public function user_issue()
    {
        return $this->hasOne('App\User','id','issue_raised_by');
    }
    public function provider_issue()
    {
        return $this->hasOne('App\Provider','id','issue_raised_by');
    }
}
