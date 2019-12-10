<?php

namespace App\Exports;

use App\Kandidat;
use Maatwebsite\Excel\Concerns\FromCollection;

class KandidatExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kandidat::all();
    }
}
