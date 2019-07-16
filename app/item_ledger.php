<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class item_ledger extends Model
{
    protected $table = "item_ledger";

    public function items()
    {
        return $this->hasOne('App\items','id','item_id');
    }
}
