<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaqField extends Model
{
    protected $fillable = [
        'id','faq_id','label','type',
    ];
}
