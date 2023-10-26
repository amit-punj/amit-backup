<?php

namespace App\Exports;

use App\property_list;
use Maatwebsite\Excel\Concerns\FromCollection;

class PropertyExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return property_list::all();
    }
}
