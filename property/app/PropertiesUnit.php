<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AccessPermission;
Use Helper;

class PropertiesUnit extends Model
{
    protected $table = 'property_units';

    public function Book_appointment()
    {
        return $this->hasMany('App\Book_appointment');
        // return $this->belongsTo('App\Book_appointment');
    }

    public function contracts()
    {
        return $this->hasMany('App\Booking');
        // return $this->belongsTo('App\Book_appointment');
    }
    public function current_contracts()
    {
        $current = Helper::Date(date("Y-m-d"));
        return $this->hasOne('App\Booking','unit_id')
                ->where('status','6')
                ->where('start_date','<',$current)
                ->where('end_date','>',$current);
        // return $this->belongsTo('App\Book_appointment');
    }
    public function get_book_count()
    {   
        $orwhere = array('payment_status'=>'pending','payment_method'=>'bank');
        return $this->hasMany('App\Booking','unit_id')
                    ->where(function ($query) use ( $orwhere) {
                        $query->where('status', 6)->orWhere('status', 3)->orWhere('payment_status','paid')->orWhere('payment_status','hold');
                        $query->orWhere(function ($qry) use ($orwhere) {
                            $qry->where($orwhere);
                        });
                    } );


        // ->where('status', 6)->orWhere('status', 3)->orWhere('payment_status','paid')->orWhere('payment_status','hold')
        //     ->orWhere(function ($qry) use ($orwhere) {
        //         $qry->where($orwhere);
        //     })->get();
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
        // return $this->belongsTo('App\Book_appointment');
    }
    public function building()
    {
        return $this->belongsTo('App\Properties', 'building_id');
        // return $this->belongsTo('App\Book_appointment');
    }

    public function accessPermission($poId, $userRole, $permissionFor)
    {
        $permissions = AccessPermission::select($permissionFor)->where('po_id',$poId)
                                        ->where('user_role',$userRole)
                                        ->get();
        if(count($permissions) > 0 ){
            $data = $permissions->toArray();
            return $data[0][$permissionFor];
        } else {
            return false;
        }
    }
}
