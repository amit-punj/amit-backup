<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
     protected $table = 'requirement';
    protected  $fillable = [
        'property_type','min_price','max_price','discription','userid','purpose','min_room','max_room','all_cash','exchange','min_bathroom','max_bathroom','amenities','city_name','local_area','longitude','latitude','client','investment_buyer','pre_approved','min_size','max_size','title'];
}
