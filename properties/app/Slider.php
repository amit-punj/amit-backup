<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
  protected $table = 'slider';
    protected  $fillable = ['title','description','search_bar','slider_image','status'];
}
