<?php

namespace App\Exports;

use App\Models\Almuerzo;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AlmuerzoExport implements FromView, ShouldAutoSize
{
    protected $date;
    public function __construct($date)
    {
        $this->date = $date;
    }

    public function view(): \Illuminate\Contracts\View\View
    {
        return view('exports.almuerzo', [
            'almuerzo' => Almuerzo::with(['deportisa','invitado','invitado.tipoInvitado','horario'])->where('horario_comida_id', $this->date)->get()
        ]);
    }

}

