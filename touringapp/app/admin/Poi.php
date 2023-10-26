<?php

namespace App\admin;

use Illuminate\Database\Eloquent\Model;

class Poi extends Model
{
    //
    protected $table = 'poi';


    protected $fillable = ['id','poi_id','tour_id','default_poi','variation_id','poi_name','lat','long','poi_location','icon_type','content_type','content','image'];

}
