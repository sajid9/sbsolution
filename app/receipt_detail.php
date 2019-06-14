<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class receipt_detail extends Model
{
    protected $table = 'receipt_detail';
    
    public function item()
    {
        return $this->hasOne('App\items', 'id', 'item_id');
    }
}
