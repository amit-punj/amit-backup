<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class agent_connect extends Model
{
    protected $table = 'agent_connect';
    protected  $fillable = [
        'user_id','agent_id','confirm','created_at','updated_at'];

    public function user()
    {
       return $this->belongsTo('App\User', 'user_id');
    }
    public function users()
    {
    	return $this->belongsTo('App\User', 'agent_id');
    }
}
