<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class items extends Model
{
    public function companies()
    {
        return $this->hasOne('App\companies', 'id', 'company_id');
    }

    public function categories()
    {
        return $this->hasOne('App\categories', 'id', 'category_id');
    }

    public function countries()
    {
        return $this->hasOne('App\countries', 'id', 'country_id');
    }

    public function classes()
    {
        return $this->hasOne('App\classes', 'id', 'class_id');
    }
    public function groups()
    {
        return $this->hasOne('App\groups', 'id', 'group_id');
    }
}
