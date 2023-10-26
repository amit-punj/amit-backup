<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book_appointment extends Model
{
    protected $table = 'book_appointment';

 	protected $fillable = ['tenent_id','time','unit_id','contract_id','pde_id','title','description'];
     
    public function unit()
    {
    	return $this->belongsTo('App\PropertiesUnit', 'unit_id');
        // return $this->hasMany('App\PropertiesUnit');
        // return $this->hasMany('App\Book_appointment');
    }
}
