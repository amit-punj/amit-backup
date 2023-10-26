<?php

namespace App\admin;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
    protected $table = 'users';


    protected $fillable = ['id', 'email', 'role','name','fname','lname','company','company_name','company_address','company_vat','password'];

}
