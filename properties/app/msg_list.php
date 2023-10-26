<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class msg_list extends Model
{
   protected $table = 'msg_list';
    protected  $fillable = [
        'user_id', 'reciver_id','last_message_id','delete_status','created_at','updated_at'];

    public function sender()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }
    public function reciver()
    {
      return $this->belongsTo('App\User', 'reciver_id');
    }
    public function last_message()
    {
    	return $this->belongsTo('App\messages','last_message_id');
    } 
}
