<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class delete_conversation extends Model
{
    protected $table = 'delete_conversation';
    protected  $fillable = [
        'delete_1','delete_2','created_at','updated_at'];
}
