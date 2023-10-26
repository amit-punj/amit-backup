<?php

namespace App\Imports;

use App\property_list;
use Maatwebsite\Excel\Concerns\ToModel;

class PropertyImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // echo "<pre>";
        print_r($row);
        // die('aaaa');
        return new property_list([

            'property_type'     => $row['name'],
            'discription'    => $row['email'], 
            // 'property_type'  => '11', 
            // 'size'  => $row['size'],
            // 'price'  => $row['price'],
            // 'rooms'  => $row['rooms'],
            // 'discription'  => $row['discription'],
            // 'user_id'  => $row['user_id'],
            // 'created_by'  => $row['created_by'],
            // 'city_name'  => $row['city_name'],
            // 'local_area'  => $row['local_area'],
            // 'useremail'  => $row['useremail'],
            // 'purpose'  => $row['purpose'],
            // 'cover_image'  => $row['cover_image'],
            // 'all_cash'  => $row['all_cash'],
            // 'exchange'  => $row['exchange'],
            // 'bathroom'  => $row['bathroom'],
            // 'title'  => $row['title'],
            // 'client'  => $row['client']
        ]);
    }
}
