<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deporte extends Model
{
    use HasFactory;
    protected $table = 'deportes';
    protected $primaryKey = 'deporte_id';
    protected $fillable = ['deporte','descripcion'];

    public function ActividadDeportiva()
    {
        return $this->hasMany(ActividadDeportiva::class);
    }
    public function deportista()
    {
        return $this->belongsTo(Deportista::class, 'id');
    }
}
