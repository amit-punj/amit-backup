<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'area_city';

    protected $fillable = [
        'id','name','unit','service','longitude','latitude',
    ];
}
