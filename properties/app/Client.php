<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
  protected $table = 'client';
    protected  $fillable = ['username','fname','lname','client_image','status','email','mobile'];
}
