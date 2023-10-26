<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building_features extends Model
{
     protected $table = 'building_features';
    protected  $fillable = ['feature_name'];
}
