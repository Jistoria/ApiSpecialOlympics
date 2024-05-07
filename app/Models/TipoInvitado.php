<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoInvitado extends Model
{
    use HasFactory;
    protected $table = 'tipos_invitados';
    protected $primaryKey = 'tipo_invitado_id';
    protected $fillable = ['tipo_invitado_nombre'];
    public function invitados(){
        return $this->hasMany(Invitado::class,'tipo_invitado_id','tipo_invitado_id');
    }
}
