<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Deportista extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($deportista) {
             // Generar el código QR
            $cdl = $deportista->cedula;
            $qrCode = QrCode::size(300)->generate($cdl);
             // Guardar el código QR en el almacenamiento (storage)
            $fileName = $cdl; // Nombre del archivo basado en la cédula
            Storage::put('public/qrcodes/' . $fileName, $qrCode);
        });
        static::updating(function ($deportista) {

        });
    }

    protected $table = 'deportistas';

    protected $primarKey = 'id';
    protected $fillable = [
        'cedula',
        'numero_deportista',
        'provincia_id',
        'nombre',
        'apellido',
        'edad',
        'genero',
        'fecha_nacimiento',
        'url_imagen',
        'activo',
    ];
    protected $formato = 'Y-m-d';
    protected $casts = [
        'fecha_nacimiento' => 'date',
        'activo' => 'boolean',
    ];

    // protected $appends = ['qr'];



    /**
     * Obtener la provincia asociada al deportista.
     */
    public function provincia()
    {
        return $this->belongsTo(Provincia::class, 'provincia_id');
    }


    /**
     * Obtener los almuerzos asociados al deportista.
     */
    public function almuerzos()
    {
        return $this->hasMany(Almuerzo::class);
    }


    /**
     * Obtener la URL de la imagen del deportista.
     */
    public function qr()
    {
        return $this->Storage::get(filePath: 'public/qrcodes/' . $this->cedula);
    }
    public function Deporte()
    {
        return $this->hasMany(Deporte::class);
    }

    public function getRouteKeyName()
    {
        return 'cedula'; // Utiliza 'cedula' como la clave de ruta en lugar de 'id'
    }
}
