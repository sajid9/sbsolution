<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payments extends Model
{
    //
    public function voucher()
    {
    	return $this->hasOne('App\voucher','id','voucher_id');
    }
    public function receipt()
    {
    	return $this->hasOne('App\receipt','id','receipt_id');
    }
    public function account()
    {
    	return $this->hasOne('App\accounts','id','account_id');
    }
    public function customer()
    {
    	return $this->hasOne('App\customers','id','customer_id');
    }
    public function supplier()
    {
    	return $this->hasOne('App\suppliers','id','supplier_id');
    }
}
