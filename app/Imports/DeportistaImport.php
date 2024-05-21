<?php

namespace App\Imports;

use App\Models\ActividadDeportiva;
use App\Models\Deporte;
use App\Models\Deportista;
use App\Models\Provincia;
use App\Rules\CedulaEcuatoriana;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DeportistaImport implements ToModel, WithHeadingRow, WithValidation, WithChunkReading
{

    private $deporte;
    private $act;
    public function __construct()
    {
        $this->deporte = Deporte::pluck('deporte_id','deporte');
        $this->act = ActividadDeportiva::pluck('actividad_id','actividad');
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //PREPARANDO LOS DATOS PARA EL MODELO
        $provincia_id= Provincia::select('provincia_id')->where('provincia','LIKE',$row['provincia'])->first();
        $nameParts = explode(',',$row['name']);
        $apellido = ucwords(strtolower($nameParts[0]));
        $apellido = str_replace(['ñ', 'Ñ'], ['n', 'N'], $apellido);

        $name = ltrim(strtr($nameParts[1],['_'=>' ']));
        $name = str_replace(['ñ', 'Ñ'], ['n', 'N'], $name);


        $cedula = $row['cedula'];
        $fechaNacimiento = $row['dob'] ? Carbon::createFromFormat('d/m/Y', $row['dob'])->format('Y-m-d') : null;
        $actividades = explode(', ', strtr($row['evento'],['  ' =>' ']));
        // Generar el código QR
        $qrCode = QrCode::size(300)->generate($cedula);
             // Guardar el código QR en el almacenamiento (storage)
            $fileName = $cedula ; // Nombre del archivo basado en la cédula
            Storage::put('public/qrcodes/' . $fileName, $qrCode);
            $url_imagen = strtolower("storage/images/".$row['provincia']."/"."$apellido $name $cedula.jpg");
            $url_imagen = str_replace(' ', '_', $url_imagen);
            $new_deportista = new Deportista([
                'nombre' => $name,
                'cedula' => $cedula,
                'apellido' => $apellido,
                'genero' => $row['gen'],
                'edad' => $row['age'],
                'numero_deportista' => $row['peto'],
                'deporte_id' => $this->deporte[$row['deporte']],
                'fecha_nacimiento' => $fechaNacimiento,
                'url_imagen' => $url_imagen,
                'provincia_id' => $provincia_id->provincia_id,
            ]);
        $ids = array_map(function($actividad) {
            return $this->act[rtrim($actividad)];
        }, $actividades);
        $new_deportista->save(); // Guarda el modelo en la base de datos
        $new_deportista->actividades_deportivas()->attach($ids);
        return $new_deportista;
    }
    public function headingRow(): int
    {
        return 4;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'cedula' => ['required','unique:deportistas,cedula'],
            // 'dob' => 'date_format:d/m/Y',
            'gen' => 'required|in:M,F',
            // 'age' => 'numeric',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'name.required' => 'El nombre es requerido',
            'name.regex' => 'El nombre solo puede contener letras',
            'cedula.required' => 'La cédula es requerida',
            'cedula.unique' => 'La cédula ya existe en la base de datos',
            'dob.required' => 'La fecha de nacimiento es requerida',
            'dob.date_format' => 'La fecha de nacimiento debe tener el formato dd/mm/yyyy',
            'gen.required' => 'El género es requerido',
            'gen.in' => 'El género debe ser M o F',
            'age.required' => 'La edad es requerida',
            'age.numeric' => 'La edad debe ser un número',
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }

}
