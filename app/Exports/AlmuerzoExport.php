<?php

namespace App\Exports;

use App\Models\Almuerzo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\FromQuery;
class AlmuerzoExport implements FromQuery
{
    public function __construct(private $date = $date)
    {}

    public function query()
    {
        return Almuerzo::query()->where('fecha', $this->date);
    }
}

