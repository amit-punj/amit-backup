<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class property_views extends Model
{
  protected $table = 'property_views';
    protected  $fillable = ['user_id','property_id','ip_address'  ];
}
