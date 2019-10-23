<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class receipt_ledger extends Model
{
    protected $table = 'receipt_ledger';

    public function customer(){
    	return $this->hasOne('App\customers','id','customer_id');
    }

    public function receipt(){
    	return $this->hasOne('App\receipt','id','receipt_id');
    }
}
