<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadDeportiva extends Model
{
    use HasFactory;

    protected $table = 'actividades_deportivas';

    protected $primaryKey = 'actividad_id';

    protected $fillable = ['deporte_id', 'actividad', 'descripcion'];

    protected $hidden = ['created_at', 'updated_at'];
    public function deporte()
    {
        return $this->belongsTo(Deporte::class, 'deporte_id');
    }
    public function lugar()
    {
        return $this->belongsToMany(Lugar::class, 'lugar_actividad_horario', 'actividad_id', 'lugar_id');
    }
}
