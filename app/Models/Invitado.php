<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitado extends Model
{
    use HasFactory;
    protected $table = 'invitados';
    protected $primaryKey = 'invitado_id';
    protected $fillable = ['provincia_id','tipo_invitado_id','nombre','apellido','cedula','edad','genero','activo'];
    //Relacion a provincia
    public function provincia(){
        return $this->belongsTo(Provincia::class,'provincia_id','provincia_id');
    }
    //Relacion a tipo invitado
    public function tipoInvitado(){
        return $this->belongsTo(TipoInvitado::class,'tipo_invitado_id','tipo_invitado_id');
    }
}

