<?php

namespace App\Exports;

use App\Models\Almuerzo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\FromQuery;
class AlmuerzoExport implements FromQuery
{
    protected $date;
    public function __construct($date)
    {
        $this->date = $date;
    }


    public function query()
    {
        return Almuerzo::query()->where('horario_comida_id', $this->date);
    }
}

