<?php

namespace App\admin;

use Illuminate\Database\Eloquent\Model;

class Passwords extends Model
{
    //
    protected $table = 'tour_passwords';


    protected $fillable = ['id','tour_id', 'current_password','password','password_type','set_password','status'];

}
