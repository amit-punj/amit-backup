<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class requirement_views extends Model
{
  protected $table = 'requirement_views';
    protected  $fillable = ['user_id','requirement_id','ip_address'  ];
}
