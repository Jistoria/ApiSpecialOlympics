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
        $almuerzos = Almuerzo::with(['deportista', 'invitado', 'invitado.tipoInvitado', 'horarioComida'])
                            ->where('horario_comida_id', $this->date)
                            ->get();

        // Calcular los totales
        $total = $almuerzos->count();
        $entregados = $almuerzos->where('entregado', true)->count();
        $no_entregados = $total - $entregados;

        // Pasar los datos y los contadores a la vista
        return view('exports.almuerzo', [
            'almuerzos' => $almuerzos,
            'total' => $total,
            'entregados' => $entregados,
            'no_entregados' => $no_entregados
        ]);
    }

}

