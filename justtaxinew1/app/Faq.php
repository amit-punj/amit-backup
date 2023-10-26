<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'faqs';


    protected $fillable = [
        'id',
        'category_id',
        'question',
        'answer',
        'label_of_field',
        'type_of_field',
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
