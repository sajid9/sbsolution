<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subhead extends Model
{
    protected $table = 'sub_head';

    public function head()
    {
    	return $this->hasOne('App\head','id','head_id');
    }
}
