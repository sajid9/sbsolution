<?php

namespace App\Imports;

use App\items;
use Maatwebsite\Excel\Concerns\ToModel;
use CH;
class CsvImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $userId = CH::getId();
        if($row[0] != 'item_name'){
        return new items([
            "item_name" => $row[0],
            "item_desc" => $row[1],
            "barcode" => $row[2],
            "purchase_price" => $row[3],
            "sale_price" => $row[4],
            "duration" => $row[5],
            "color" => $row[6],
            "low_stock" => $row[7],
            "type" => $row[8],
            "store_id" => $row[9],
            "company_id" => $row[10],
            "class_id" => $row[11],
            "sub_class_id" => $row[12],
            "is_active" => $row[13],
            "user_id" => $userId,
        ]);
        }
    }
}
