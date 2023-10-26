<?php

namespace App\admin;

use Illuminate\Database\Eloquent\Model;

class Poicontent extends Model
{
    //
    protected $table = 'poi_content';


    protected $fillable = ['id','poi_id','tour_id', 'variation_id','content','image'];

}
