<?php

namespace App\Imports;

use App\Models\Deporte;
use App\Models\Invitado;
use App\Models\Provincia;
use App\Models\TipoInvitado;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
        $nameParts = explode(', ',$row['name']);
        $lastname = ucwords(strtolower($nameParts[0]));
        $name = ucwords(strtolower($nameParts[1]));
        $fechaNacimiento = Carbon::createFromFormat('d/m/Y', $row['dob'])->format('Y-m-d');
         // Generar el código QR
        $cedula = $row['cedula'];
        $qrCode = QrCode::size(300)->generate($cedula);
         // Guardar el código QR en el almacenamiento (storage)
        $fileName = $cedula; // Nombre del archivo basado en la cédula
        Storage::put('public/qrcodes/' . $fileName, $qrCode);
        $url_imagen = strtolower("storage/images/".$row['provincia']."/"."$lastname $name $fileName.jpg");
        $url_imagen = str_replace(' ', '_', $url_imagen);
        return new Invitado([
            'cedula' => $row['cedula'],
            'nombre' => $name,
            'apellido' => $lastname,
            'genero' => $row['gen'],
            'url_imagen' => $url_imagen,
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
