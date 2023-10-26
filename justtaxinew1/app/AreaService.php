<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaService extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'area_id',
        'area_name',
        'restriction_type',
        'service',
        'latitude',
        'longitude',
        'name',
        'provider_name',
        'image',
        'price',
        'fixed',
        'description',
        'status',
        'minute',
        'hour',
        'distance',
        'calculator',
        'capacity',
        'night_charges', 
        'airport_charges', 
        'cancellation_fee' , 
        'platform_fee', 
        'surge' ,
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
}
