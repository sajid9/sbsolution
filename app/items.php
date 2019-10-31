<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class items extends Model
{
    protected $fillable = array("item_name","item_desc","barcode","purchase_price", "sale_price","duration","color","pieces","size","quality","meter","low_stock",
            "tile_type","type","store_id","group_id","unit_id","company_id","category_id","class_id","sub_class_id","country_id","is_active","user_id");
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
