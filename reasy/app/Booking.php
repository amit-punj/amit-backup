<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $table = 'unit_booking';

    protected $fillable = [
        'id', 'unit_id', 'step','lad_id','contract_id','tenant_id','guarantor_id','pde_id','vo_id','po_id','pm_id','transaction_id','contract_type','start_date','end_date','total_amount','payment_method','status','tenant_photo','tenant_photo_id_proof','tenant_photo_esignature','payment_status','contract_communication_language','signature_date', 'rent', 'cost_provision', 'fixed_charges', 'property_tax', 'deposit_amount', 'contract_time', 'bank_receipt', 'receipt_status','tenant_pay_slip','choose_guarantor','dues','damage','receipt_upload_time','rent_agreement'
    ];

    public function unit()
    {
    	return $this->belongsTo('App\PropertiesUnit', 'unit_id');
        // return $this->hasMany('App\PropertiesUnit');
        // return $this->hasMany('App\Book_appointment');
    }

    public function pde()
    {
        return $this->belongsTo('App\User', 'pde_id');
        // return $this->hasMany('App\PropertiesUnit');
        // return $this->hasMany('App\Book_appointment');
    }

    public function assigned()
    {
        return $this->belongsTo('App\User', 'assigned_to');
        // return $this->hasMany('App\PropertiesUnit');
        // return $this->hasMany('App\Book_appointment');
    }
    public function create()
    {
        return $this->belongsTo('App\User', 'created_by');
        // return $this->hasMany('App\PropertiesUnit');
        // return $this->hasMany('App\Book_appointment');
    }
    public function child()
    {
    	// return $this->belongsTo('App\appointments', 'parent');
        return $this->hasMany('App\appointments', 'parent');
        // return $this->hasMany('App\Book_appointment');
    }
    public function transactions()
    {
        // return $this->belongsTo('App\appointments', 'parent');
        return $this->belongsTo('App\Transactions', 'transaction_id');
        // return $this->hasMany('App\Book_appointment');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'tenant_id');
        // return $this->hasMany('App\PropertiesUnit');
        // return $this->hasMany('App\Book_appointment');
    }

    public function account()
    {
        return $this->belongsTo('App\UserBankAccount', 'tenant_id', 'user_id');
        // return $this->hasMany('App\PropertiesUnit');
        // return $this->hasMany('App\Book_appointment');
    }
    public function PO_account()
    {
        return $this->belongsTo('App\UserBankAccount', 'po_id', 'user_id');
        // return $this->hasMany('App\PropertiesUnit');
        // return $this->hasMany('App\Book_appointment');
    }
    public function rating()
    {
        return $this->hasMany('App\Rating', 'contract_id');
    }

    //0 = draft,1= pending payment, 2= payment done, 3 = accept, 4 = reject by pm, 5 = expert done, 6 = complete, 7 = cancel by tenant, 8 = terminate
    public function status($id) {
        if($id == 0){
            return 'Draft';
        } elseif($id == 1){
            return 'Pending Payment';
        } elseif($id == 2){
            return 'Payment Done';
        } elseif($id == 3){
            return 'Accept';
        } elseif($id == 4){
            return 'Reject By PM';
        } elseif($id == 5){
            return 'Expert Done';
        } elseif($id == 6){
            return 'Complete';
        } elseif($id == 7){
            return'Cancel By Tenant';
        } elseif($id == 8){
            return 'Terminate';
        }

    }
}
