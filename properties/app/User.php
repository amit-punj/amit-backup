<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

const SUPER_USER = 1;
const OFFICE_ADMIN= 2;
const AGENT = 3;
const USER_DEFAULT = 4;
const USER_DISABLED = 0;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role','phone_no','telephone','address','zipcode','fname','lname','profile_pic'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function isAdmin()    {
        return (int)$this->role === self::SUPER_USER;
    }
    public function subadmin()
    {
        return (int)$this->role === self::OFFICE_ADMIN;  
    }
    public function isAgent(){
        return (int)$this->role === self::AGENT;
    }
 }
