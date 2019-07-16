<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class supplier_history extends Model
{
    protected $table = "supplier_history";

    public function supplier()
    {
        return $this->hasOne('App\suppliers','id','supplier_id');
    }
}
