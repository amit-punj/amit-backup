<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class messages extends Model
{
    protected $table = 'messages';
    protected  $fillable = [
        'sender_id', 'reciver_id','message','file','delete_1','delete_2','created_at','updated_at'];

    public function sender()
    {
    	return $this->belongsTo('App\User', 'sender_id');
    }
    public function reciver()
    {
      return $this->belongsTo('App\User', 'reciver_id');
    }    
}
