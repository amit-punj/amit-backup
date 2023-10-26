<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifyEmail extends Model
{
    protected $table = 'verify_emails';

    protected $fillable = [
       'email', 'confirmation_code','status' ];
}
