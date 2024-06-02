<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class AtletaExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): \Illuminate\Contracts\View\View
    {
        return view('exports.atleta', [
            'atletas' => \App\Models\Deportista::with('deporte')->get()
        ]);
    }
}
