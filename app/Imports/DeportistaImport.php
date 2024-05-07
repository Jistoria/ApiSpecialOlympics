<?php

namespace App\Imports;

use App\Models\Deportista;
use App\Models\Provincia;
use App\Rules\CedulaEcuatoriana;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DeportistaImport implements ToModel, WithHeadingRow, WithBatchInserts, WithValidation
{

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $provincia_id= Provincia::select('provincia_id')->where('provincia','LIKE',$row['provincia'])->first();
        $nameParts = explode(',',$row['name']);
        $apellido = ucwords(strtolower($nameParts[0]));
        $name = $nameParts[1];
        $cedula = $row['cedula'];
        $fechaNacimiento = Carbon::createFromFormat('d/m/Y', $row['dob'])->format('Y-m-d');

        $qrCode = QrCode::size(300)->generate($cedula);
             // Guardar el código QR en el almacenamiento (storage)
            $fileName = $cedula ; // Nombre del archivo basado en la cédula
            Storage::put('public/qrcodes/' . $fileName, $qrCode);

        return new Deportista([
            'nombre' => $name,
            'cedula' => $cedula,
            'apellido' => $apellido,
            'genero' => $row['gen'],
            'edad' => $row['age'],
            'fecha_nacimiento' => $fechaNacimiento,
            'url_imagen' => "$apellido$name $cedula.jpg",
            'provincia_id' => $provincia_id->provincia_id,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|regex:/^[a-zA-Z,_\s]*$/',
            'cedula' => ['required','string','size:10','unique:deportistas,cedula', new CedulaEcuatoriana],
            'dob' => 'required|date_format:d/m/Y',
            'gen' => 'required|in:M,F',
            'age' => 'required|numeric',
        ];
    }
    public function batchSize(): int
    {
        return 1000;
    }
}
