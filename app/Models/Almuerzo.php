<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almuerzo extends Model
{
    use HasFactory;

    protected $table = 'almuerzos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'invitado_id',
        'deportista_id',
        'horario_comida_id',
        'completado'
    ];

    public function invitado()
    {
        return $this->belongsTo(Invitado::class,'invitado_id');
    }
    public function horarioComida()
    {
        return $this->belongsTo(HorarioComida::class);
    }
    public function deportista()
    {
        return $this->belongsTo(Deportista::class);
    }
}
