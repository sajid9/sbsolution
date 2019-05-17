<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class voucher_detail extends Model
{
    protected $table = "voucher_detail";

    public function item()
    {
        return $this->hasOne('App\items', 'id', 'item_id');
    }
}
