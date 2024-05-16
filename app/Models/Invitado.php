<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Invitado extends Model
{
    use HasFactory;
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($guest) {
             // Generar el código QR
            $cdl = $guest->cedula;
            $qrCode = QrCode::size(300)->generate($cdl);
             // Guardar el código QR en el almacenamiento (storage)
            $fileName = $cdl; // Nombre del archivo basado en la cédula
            Storage::put('public/qrcodes/' . $fileName, $qrCode);
        });
        static::updating(function ($guest) {

        });
    }
    protected $table = 'invitados';
    protected $primaryKey = 'invitado_id';
    protected $fillable = ['provincia_id','tipo_invitado_id','nombre','apellido','deporte_id','fecha_nacimiento','cedula','edad','genero','url_imagens','activo'];
    //Relacion a provincia
    public function provincia(){
        return $this->belongsTo(Provincia::class,'provincia_id','provincia_id');
    }
    //Relacion a tipo invitado
    public function tipoInvitado(){
        return $this->belongsTo(TipoInvitado::class,'tipo_invitado_id','tipo_invitado_id');
    }

    public function credentials()
    {
        $qrFilePath = 'public/qrcodes/' . $this->cedula;
        return [
            'invitado_id' => $this->invitado_id,
            'cedula' => $this->cedula,
            'nombre' => $this->nombre,
            'qr' => Storage::exists($qrFilePath) ? Storage::get($qrFilePath) : null,
            'apellido' => $this->apellido,
            'provincia' => $this->provincia->provincia,
            'tipo_invitado' => $this->tipoInvitado->tipo_invitado_nombre,
        ];
    }
}

