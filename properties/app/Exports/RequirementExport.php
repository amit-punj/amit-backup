<?php

namespace App\Exports;

use App\Requirement;
use Maatwebsite\Excel\Concerns\FromCollection;

class RequirementExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Requirement::all();
    }
}
