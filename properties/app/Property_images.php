<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property_images extends Model
{
    protected $table = 'property_images';
    protected  $fillable = [
        'image_name', 'property_id','created_by','user_id'
    ];
}
