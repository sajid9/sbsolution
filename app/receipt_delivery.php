<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class receipt_delivery extends Model
{
	protected $table = 'receipt_delivery';
    public function item()
    {
    	return $this->hasOne('App\items','id','item_id');
    }
    public function receipt()
    {
    	return $this->hasOne('App\receipt','id','receipt_id');
    }
}
