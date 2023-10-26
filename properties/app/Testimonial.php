<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
  protected $table = 'testimonial';
    protected  $fillable = ['name','testimonial','designation','image','status'];
}
