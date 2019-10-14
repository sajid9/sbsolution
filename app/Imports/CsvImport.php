<?php

namespace App\Imports;

use App\items;
use Maatwebsite\Excel\Concerns\ToModel;

class CsvImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if($row[0] != 'item_name'){
        return new items([
            "item_name" => $row[0],
            "item_desc" => $row[1],
            "barcode" => $row[2],
            "purchase_price" => $row[3],
            "sale_price" => $row[4],
            "duration" => $row[5],
            "color" => $row[6],
            "pieces" => $row[7],
            "size" => $row[8],
            "quality" => $row[9],
            "meter" => $row[10],
            "low_stock" => $row[11],
            "tile_type" => $row[12],
            "type" => $row[13],
            "store_id" => $row[14],
            "group_id" => $row[15],
            "unit_id" => $row[16],
            "company_id" => $row[17],
            "category_id" => $row[18],
            "class_id" => $row[19],
            "sub_class_id" => $row[20],
            "country_id" => $row[21],
            "is_active" => $row[22],
        ]);
        }
    }
}
