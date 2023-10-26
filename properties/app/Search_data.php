<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search_data extends Model
{
    protected $table = 'search_data';
    protected  $fillable = [
        'user_id','title','url','search_type','created_at','updated_at'];
}