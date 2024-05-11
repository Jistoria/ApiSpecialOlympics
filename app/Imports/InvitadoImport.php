<?php

namespace App\Imports;

use App\Models\Deporte;
use App\Models\Invitado;
use App\Models\Provincia;
use App\Models\TipoInvitado;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvitadoImport implements ToModel, WithHeadingRow
{
    private $deportes;
    private $tipos_invitados;
    public function __construct()
    {
        $this->deportes = Deporte::pluck('deporte_id','deporte');
        $this->tipos_invitados = TipoInvitado::pluck('tipo_invitado_id','tipo_invitado_nombre');

    }
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        $provincia_id= Provincia::select('provincia_id')->where('provincia','LIKE',$row['provincia'])->first();
        $nameParts = explode(' ',$row['name']);
        $total_name = ucwords(strtolower($nameParts[0])).$nameParts[1];
        $fechaNacimiento = Carbon::createFromFormat('d/m/Y', $row['dob'])->format('Y-m-d');
        return new Invitado([
            'cedula' => $row['cedula'],
            'nombre' => $row['name'],
            'genero' => $row['gen'],
            'edad' => $row['age'],
            'fecha_nacimiento' => $fechaNacimiento,
            'deporte_id' => $this->deportes[$row['deporte']]??null,
            'tipo_invitado_id' => $this->tipos_invitados[$row['tipo']],
            'provincia_id' => $provincia_id->provincia_id,
        ]);
    }


    public function headingRow(): int
    {
        return 4;
    }
    public function rules(): array
    {
        return [
            'name' => 'required|regex:/^[a-zA-ZñÑ,_\s]*$/',
            'cedula' => ['required','unique:invitados,cedula'],
            'dob' => 'required|date_format:d/m/Y',
            'gen' => 'required|in:M,F',
            'age' => 'required|numeric',
        ];
    }
}
