<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioComida extends Model
{
    use HasFactory;

    protected $table = 'horario_comida';
    protected $primaryKey = 'id';
    protected $fillable = [
        'horario',
        'fecha',
        'hora_inicio',
        'hora_fin'
    ];
    public function almuerzos()
    {
        return $this->hasMany(Almuerzo::class);
    }
}
