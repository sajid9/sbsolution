<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class voucher_receiving extends Model
{
    protected $table = 'voucher_receiving';

    public function item()
    {
    	return $this->hasOne('App\items','id','item_id');
    }
}
