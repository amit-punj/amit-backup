<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class property_list extends Model
{
  protected $table = 'property_list';
    protected  $fillable = [
        'property_type', 'size','price','rooms','discription','user_id','created_by','city_name','local_area','useremail','purpose','cover_image','all_cash','exchange','bathroom','title','client'];
}
