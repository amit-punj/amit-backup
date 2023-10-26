<?php

namespace App\admin;

use Illuminate\Database\Eloquent\Model;

class Variations extends Model
{
    //
    protected $table = 'variations';


    protected $fillable = ['id','tour_id', 'variation_name','language'];

}
