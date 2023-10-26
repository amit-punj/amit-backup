<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderVehicleDocument extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'provider_id',
        'vehicle_id',
        'document_id',
        'url',
        'unique_id',
        'expiry',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The services that belong to the user.
     */
    public function provider()
    {
        return $this->belongsTo('App\Provider');
    } 
    public function vehicle()
    {
        return $this->belongsTo('App\Provider');
    }
    /**
     * The services that belong to the user.
     */
    public function document()
    {
        return $this->belongsTo('App\Document');
    }
}
