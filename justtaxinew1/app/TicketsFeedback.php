<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketsFeedback extends Model
{
     protected $table = 'tickets_feedback';

    protected $fillable = [
        'id','ticket_id','role','sender','reply',
    ];
}
