<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class supplier_ledger extends Model
{
    protected $table = 'supplier_ledger';

    public function supplier(){
    	return $this->hasOne('App\suppliers','id','supplier_id');
    }

    public function voucher(){
    	return $this->hasOne('App\voucher','id','voucher_id');
    }
}
