<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'category';


    protected $fillable = [
        'id',
        'parent',
        'category',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'created_at', 'updated_at'
    ];

    public function service_type()
    {
        return $this->belongsTo('App\ServiceType','name');
    }
    public function category_name()
    {
        return $this->belongsTo('App\Category','parent');
    }
}
