<?php

namespace App\admin;

use Illuminate\Database\Eloquent\Model;

class Tours extends Model
{
    //
    protected $table = 'tours';


    protected $fillable = ['id', 'tour_name','tour_owner','center_lattitude','center_longitude','top','right','bottom','left','minimum_zoom','maximum_zoom','password','set_password', 'password_type', 'current_password','tour_control'];

}
