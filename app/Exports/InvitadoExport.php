<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class InvitadoExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): \Illuminate\Contracts\View\View
    {
        return view('exports.invitado', [
            'invitados' => \App\Models\Invitado::with('tipoInvitado')->get()
        ]);
    }
}
