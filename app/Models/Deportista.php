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
        'deporte_id',
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

    public function actividades_deportivas()
    {
        return $this->belongsToMany(ActividadDeportiva::class, 'actividad_deportista', 'deportista_id', 'actividad_id')
            ->withPivot('resultados')
            ->withTimestamps();
    }
    protected $hidden = ['created_at', 'updated_at'];
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
    $qrFilePath = 'public/qrcodes/' . $this->cedula;

    if (Storage::exists($qrFilePath)) {
        return Storage::get($qrFilePath);
    }

    return null; // O manejar de otra manera si el archivo no existe
}

    public function Deporte()
    {
        return $this->belongsTo(Deporte::class,'deporte_id');
    }

    public function getRouteKeyName()
    {
        return 'cedula'; // Utiliza 'cedula' como la clave de ruta en lugar de 'id'
    }

    public function getAll()
    {
        return [
            'id' => $this->id,
            'dni' => $this->cedula,
            'sportsman_number' => $this->numero_deportista,
            'address' => $this->provincia->provincia,
            'name' => $this->nombre.' '.$this->apellido,
            'age' => $this->edad,
            'gender' => $this->genero,
            'birthday' => $this->fecha_nacimiento->format($this->formato),
            'img_url' => $this->url_imagen,
        ];
    }

    public function getFechaNacimientoAttribute($value)
    {
        return $this->attributes['fecha_nacimiento'] = $value->format($this->formato);
    }
}
