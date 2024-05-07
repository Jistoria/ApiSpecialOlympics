<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almuerzo extends Model
{
    use HasFactory;

    protected $table = 'almuerzos';

    protected $fillable = [
        'deportista_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'completado'
    ];


    public function deportista()
    {
        return $this->belongsTo(Deportista::class);
    }
}
