<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer_ledger extends Model
{
    protected $table = 'customer_ledger';

    public function customer()
    {
    	return $this->hasOne('App\customers','id','customer_id');
    }
}
